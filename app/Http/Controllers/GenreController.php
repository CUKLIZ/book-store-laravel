<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function showProducts(Category $category, Genre $genre) {
        if ($genre->category_id !== $category->id) {
            abort(404);
        }

        $products = $genre->products()->paginate(12);
        return view('genres.products', compact('category', 'genre', 'products'));
    }
}
