<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Dashboard Redirect
Route::redirect('/dashboard', '/', 301)->name('dashboard');

// Protected Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
});

// Auth Routes
require __DIR__.'/auth.php';

// Category Routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.showAll');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('category/{category:slug}/genres', [CategoryController::class, 'showGenres'])->name('category.genres');
Route::get('category/{category:slug}/genres/{genre:slug}', [CategoryController::class, 'showProducts'])->name('genre.products');

// Product Detail Route
Route::get('/products/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

// Email Verification
Route::get('/email/verified', function () {
    if (!session()->has('verification_success_token')) {
        return redirect()->route('home');
    }
    return view('auth.verified');
})->name('verification.success')->middleware(['auth', 'verified']);

// Search Routes dengan Rate Limiting
Route::middleware('throttle:60,1')->group(function () {
    // AJAX Search - 60 requests per minute
    Route::get('/api/search', [SearchController::class, 'ajaxSearch'])->name('search.ajax');
    
    // Full Search Page - 60 requests per minute
    Route::get('/search', [SearchController::class, 'search'])->name('search.page');
});