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

        $currentPage = $products->currentPage();
        $lastPage = $products->lastPage();

        if ($currentPage > $lastPage && $lastPage > 0) {
            return redirect($products->url($lastPage))->with('warning', 'Halaman yang Anda minta terlalu besar. Anda diarahkan ke halaman terakhir.');
        }

        if ($request->ajax()) {
            return view('components.product', compact('products'))->render();
        }

        return view('home', compact('products', 'categories'));
    }
}