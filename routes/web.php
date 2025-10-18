<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Dashboard Redirect (Memastikan pengguna yang login diarahkan ke Home)
Route::redirect('/dashboard', '/', 301)->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Rute upload foto profil
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    
    // Tempat yang bagus untuk menambahkan rute-rute penting e-commerce lainnya:
    // Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    // Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

require __DIR__.'/auth.php';

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.showAll');
// Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('category.show');

Route::get('/email/verified', function () {
    // 🔥 LANGKAH BARU 2: Cek token sesi sebelum menampilkan view
    if (! session()->has('verification_success_token')) {
        // Jika token tidak ada (diakses langsung/refresh), arahkan ke Home
        return redirect()->route('home');
        // Atau ke rute yang lebih sesuai jika ada, misalnya '/profile'
    }

    // Jika token ada (baru saja dari proses verifikasi), tampilkan view
    return view('auth.verified');
})->name('verification.success')->middleware(['auth', 'verified']);
// middleware('auth')->name('verification.notice')

Route::get('category/{category:slug}/genres', [CategoryController::class, 'showGenres'])->name('category.genres');
Route::get('category/{category:slug}/genres/{genre:slug}', [CategoryController::class, 'showProducts'])->name('genre.products');