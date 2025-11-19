@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded shadow mt-10 text-center">
    <h1 class="text-2xl font-bold mb-4">Оформлення замовлення</h1>
    <p class="text-gray-600 mb-6">До сплати: <span class="font-bold text-xl text-blue-600">{{ $total }} ₴</span></p>

    {{-- Форма LiqPay --}}
    <form method="POST" action="https://www.liqpay.ua/api/3/checkout" accept-charset="utf-8">
        {{-- Приховані поля, які передають дані на LiqPay --}}
        <input type="hidden" name="data" value="{{ $data }}" />
        <input type="hidden" name="signature" value="{{ $signature }}" />

        {{-- Кнопка оплати --}}
        <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded w-full flex justify-center items-center">
            <img src="https://static.liqpay.ua/buttons/logo-small.png" class="h-6 mr-2" alt="LiqPay">
            Оплатити через LiqPay
        </button>
    </form>

    <a href="{{ route('cart.index') }}" class="block mt-4 text-gray-500 hover:underline text-sm">Назад до кошика</a>
</div>
@endsection
