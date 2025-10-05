<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Homepage yang bisa diakses publik
Route::get('/', [HomeController::class, 'index'])->name('home');

// Dashboard yang juga bisa diakses publik (tanpa middleware 'auth')
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); 

// Ubah error 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
