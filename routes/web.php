<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Homepage yang bisa diakses publik
Route::get('/', [HomeController::class, 'index'])->name('home');

// Ubah error 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.showAll');
// Gunakan rute standar karena slug sekarang bersih (contoh: /categories/misteri-thriller)
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('category.show');