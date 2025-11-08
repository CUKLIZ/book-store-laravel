<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        $relatedProducts = collect();

        // Priority 1: Same author + same category
        if ($product->author) {
            $sameAuthor = Product::where('category_id', $product->category_id)
                ->where('author', $product->author)
                ->where('id', '!=', $product->id)
                ->where('stock', '>', 0)
                ->inRandomOrder()
                ->take(2)
                ->get();
            $relatedProducts = $relatedProducts->merge($sameAuthor);
        }

        // Priority 2: Same category + similar price
        if ($relatedProducts->count() < 5) {
            $priceMin = $product->price * 0.7; // -30%
            $priceMax = $product->price * 1.3; // +30%

            $similarPrice = Product::where('category_id', $product->category_id)
                ->whereBetween('price', [$priceMin, $priceMax])
                ->where('id', '!=', $product->id)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->where('stock', '>', 0)
                ->inRandomOrder()
                ->take(5 - $relatedProducts->count())
                ->get();
            $relatedProducts = $relatedProducts->merge($similarPrice);
        }

        // Priority 3: Just same category
        if ($relatedProducts->count() < 5) {
            $sameCategory = Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->where('stock', '>', 0)
                ->inRandomOrder()
                ->take(5 - $relatedProducts->count())
                ->get();
            $relatedProducts = $relatedProducts->merge($sameCategory);
        }

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
