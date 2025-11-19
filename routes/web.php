<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// 1. Головна сторінка (публічна)
Route::get('/', function () {
    // Якщо користувач вже увійшов -> перекидаємо його одразу в каталог
    if (auth()->check()) {
        return redirect()->route('products.index');
    }
    // Якщо ні -> показуємо сторінку входу/вітання
    return view('welcome');
})->name('home');

// 2. Група маршрутів ТІЛЬКИ для авторизованих користувачів
Route::middleware(['auth'])->group(function () {

    // Каталог товарів (тепер тут, а не на головній)
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // Кошик
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::get('/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
        Route::post('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    });

    // Адмінська частина (видалення та створення)
    Route::middleware(['admin'])->group(function () {
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product', [ProductController::class, 'store'])->name('product.store');

        // ! НОВЕ: Маршрут для видалення товару
        Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });
});

require __DIR__.'/auth.php';
