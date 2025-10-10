<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all(); 
        
        return view('categories.index', compact('categories'));
    }

    public function show($slug) {
        $category = Category::where('slug', $slug)->firstOrFail(); 
        $products = $category->products()->paginate(12); 
        
        return view('categories.show', compact('category', 'products'));
    }
}
