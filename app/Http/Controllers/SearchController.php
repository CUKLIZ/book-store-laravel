<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    // AJAX search untuk dropdown
    public function ajaxSearch(Request $request)
    {
        try {
            $validated = $request->validate([
                'q' => 'required|string|min:2|max:255',
            ]);

            $query = trim($validated['q']);

            $cacheKey = 'ajax_search_'.md5(strtolower($query));

            $products = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($query) {
                return Product::query()
                    ->select(['id', 'name', 'author', 'slug', 'price', 'image', 'stock'])
                    ->where(function ($q) use ($query) {
                        $q->where('name', 'like', '%'.$query.'%')
                            ->orWhere('author', 'like', '%'.$query.'%');
                    })
                    ->where('stock', '>', 0) // Hanya produk dengan stok > 0
                    ->orderByRaw('
                        CASE 
                            WHEN name LIKE ? THEN 1 
                            WHEN author LIKE ? THEN 2
                            ELSE 3 
                        END
                    ', [$query.'%', $query.'%'])
                    ->take(5)
                    ->get()
                    ->map(function ($product) {
                        return [
                            'id' => $product->id,
                            'name' => $product->name,
                            'author' => $product->author,
                            'slug' => $product->slug,
                            'price' => $product->price,
                            'stock' => $product->stock,
                            'image' => $product->image
                                ? asset('storage/'.$product->image)
                                : asset('images/default-book.png'),
                        ];
                    });
            });

            return response()->json([
                'success' => true,
                'results' => $products,
                'count' => $products->count(),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Harap masukkan minimal 2 karakter',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('AJAX Search Error: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mencari',
                'results' => [],
            ], 500);
        }
    }

    // Full search untuk halaman search dengan filter dan sorting
    public function search(Request $request)
    {
        $query = $request->input('q', '');
        $query = trim($query);
        $stockFilter = $request->input('stock'); // 'all' atau null
        $sortBy = $request->input('sort');

        // Initialize default values
        $total = 0;
        $products = collect();

        // Hanya search jika query valid
        if (strlen($query) >= 2) {
            try {
                // Start query builder
                $productsQuery = Product::query()->with(['category', 'genres']);

                // Filter berdasarkan search query
                $productsQuery->where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', '%'.$query.'%')
                        ->orWhere('author', 'LIKE', '%'.$query.'%')
                        ->orWhere('description', 'LIKE', '%'.$query.'%');
                });

                // Filter berdasarkan stock
                // DEFAULT: Hanya tampilkan produk dengan stok tersedia
                // KECUALI user explicitly memilih 'all' (toggle OFF)
                if ($stockFilter !== 'all') {
                    $productsQuery->where('stock', '>', 0);
                }
                // Jika stock === 'all', tampilkan semua produk (termasuk yang habis)

                // Sorting
                switch ($sortBy) {
                    case 'newest':
                        $productsQuery->orderBy('created_at', 'desc');
                        break;
                    
                    case 'oldest':
                        $productsQuery->orderBy('created_at', 'asc');
                        break;
                    
                    case 'name_asc':
                        $productsQuery->orderBy('name', 'asc');
                        break;
                    
                    case 'name_desc':
                        $productsQuery->orderBy('name', 'desc');
                        break;
                    
                    case 'price_low':
                        $productsQuery->orderBy('price', 'asc');
                        break;
                    
                    case 'price_high':
                        $productsQuery->orderBy('price', 'desc');
                        break;
                    
                    default:
                        // Default: relevance - prioritas kecocokan nama
                        $productsQuery->orderByRaw('
                            CASE 
                                WHEN name LIKE ? THEN 1
                                WHEN author LIKE ? THEN 2
                                ELSE 3
                            END
                        ', [$query.'%', $query.'%'])
                        ->orderBy('created_at', 'desc');
                        break;
                }

                // Paginate dengan append query parameters
                $products = $productsQuery->paginate(12)->appends([
                    'q' => $query,
                    'stock' => $stockFilter,
                    'sort' => $sortBy,
                ]);

                $total = $products->total();

            } catch (\Exception $e) {
                Log::error('Full Search Error: '.$e->getMessage(), [
                    'query' => $query,
                    'stock' => $stockFilter,
                    'sort' => $sortBy,
                ]);

                // Jika error, tetap return empty collection
                $products = collect();
                $total = 0;
            }
        }

        return view('search.index', [
            'products' => $products,
            'query' => $query,
            'total' => $total,
        ]);
    }
}