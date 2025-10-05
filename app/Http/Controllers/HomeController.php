<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::paginate(12);
        $categories = Category::all();

        // Jika AJAX → return partial view saja (produk + pagination)
        if ($request->ajax()) {
            return view('components.product', compact('products'))->render();
        }

        // Jika biasa → return full page
        return view('home', compact('products', 'categories'));
    }
}
