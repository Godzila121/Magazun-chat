<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
});
