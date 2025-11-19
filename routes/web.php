<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Головна сторінка
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('products.index');
    }
    return view('welcome');
})->name('home');

// 2. Група для авторизованих користувачів
Route::middleware(['auth'])->group(function () {

    // --- ТОВАРИ ---
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

    // --- КОШИК ---
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::get('/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
        Route::post('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    });

    // --- ЗАМОВЛЕННЯ (LiqPay) ---
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::match(['get', 'post'], '/payment/success', [OrderController::class, 'success'])->name('payment.success');

    // --- ЧАТ (Клієнтська частина) ---
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');

    // --- АДМІН ПАНЕЛЬ ---
    Route::middleware(['admin'])->group(function () {
        // Управління товарами
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

        // Управління чатами
        Route::get('/admin/chat', [ChatController::class, 'adminIndex'])->name('admin.chat.index');
        Route::get('/admin/chat/{id}', [ChatController::class, 'adminShow'])->name('admin.chat.show');
        Route::post('/admin/chat/{id}', [ChatController::class, 'adminStore'])->name('admin.chat.store');
    });

}); // <--- ОСЬ ЦІЄЇ ДУЖКИ, ЙМОВІРНО, НЕ ВИСТАЧАЛО

require __DIR__.'/auth.php';
