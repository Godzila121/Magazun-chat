<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);

        // Якщо кошик порожній - назад
        if (empty($cart)) {
            return redirect()->route('products.index');
        }

        // 1. Рахуємо суму
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 2. Підготовка даних для LiqPay
        $public_key = env('LIQPAY_PUBLIC_KEY');
        $private_key = env('LIQPAY_PRIVATE_KEY');

        // Параметри замовлення
        $params = [
            'action'         => 'pay',
            'amount'         => $total,
            'currency'       => 'UAH',
            'description'    => 'Оплата замовлення в MyShop',
            'order_id'       => time(), // Унікальний ID (час в секундах)
            'version'        => '3',
            'public_key'     => $public_key,
            'result_url'     => route('payment.success'), // Куди повернути клієнта
        ];

        // 3. Кодування даних (Base64)
        $data = base64_encode(json_encode($params));

        // 4. Формування підпису (Signature)
        // Формула: base64_encode( sha1( private_key + data + private_key ) )
        $signature = base64_encode(sha1($private_key . $data . $private_key, 1));

        return view('orders.checkout', compact('data', 'signature', 'total'));
    }

    public function success()
    {
        // Очищаємо кошик після успішної оплати
        Session::forget('cart');

        return view('orders.success');
    }
}
