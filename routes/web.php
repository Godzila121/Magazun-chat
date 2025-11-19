<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
// ProfileController та інші додаються Breeze автоматично

// --- ГОЛОВНА СТОРІНКА (КАТАЛОГ) ---
Route::get('/', [ProductController::class, 'index'])->name('products.index');

// --- КОШИК ---
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
});

// --- АДМІНКА (Тільки для власника) ---
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
});

// --- АВТОРИЗАЦІЯ (Маршрути від Breeze) ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
