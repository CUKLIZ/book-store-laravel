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

    // Full search untuk halaman search
    public function search(Request $request)
    {
        $query = $request->input('q', '');
        $query = trim($query);

        // Initialize default values
        $total = 0;
        $products = collect();

        // Hanya search jika query valid
        if (strlen($query) >= 2) {
            try {
                $products = Product::query()
                    ->where(function ($q) use ($query) {
                        $q->where('name', 'LIKE', '%'.$query.'%')
                            ->orWhere('author', 'LIKE', '%'.$query.'%');
                    })
                    ->with(['category', 'genres'])
                    ->orderByRaw('
                        CASE 
                            WHEN name LIKE ? THEN 1
                            WHEN author LIKE ? THEN 2
                            ELSE 3
                        END
                    ', [$query.'%', $query.'%'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(12)
                    ->appends(['q' => $query]);

                $total = $products->total();

            } catch (\Exception $e) {
                Log::error('Full Search Error: '.$e->getMessage());

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