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

    public function show(Category $category) {
        // $category = Category::where('slug', $slug)->firstOrFail(); 
        $products = Product::whereHas('genres', function($query) use ($category) {
            $query->where('category_id', $category->id);
        })->paginate(12);
        
        return view('categories.show', compact('category', 'products'));
    }

    public function showGenres(Category $category) {
        $genres = $category->genres()->get(); 
        return view('categories.genres', compact('category', 'genres'));        
    }
}
