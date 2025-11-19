<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Показати сторінку кошика
    public function index()
    {
        $cart = session()->get('cart', []);

        // Рахуємо загальну суму
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    // Додати товар у кошик
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // Якщо товар вже є, збільшуємо кількість
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Якщо немає, додаємо новий
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Товар додано в кошик!');
    }

    // Видалити один товар
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Товар видалено!');
    }

    // Очистити весь кошик
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Кошик очищено!');
    }
}
