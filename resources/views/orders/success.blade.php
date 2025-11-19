@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto text-center mt-20">
    <div class="bg-green-100 text-green-700 p-10 rounded-lg shadow inline-block">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h1 class="text-3xl font-bold mb-2">Оплата успішна!</h1>
        <p class="text-lg">Дякуємо за ваше замовлення.</p>
        <p class="text-sm mt-2">Ми почали його обробляти.</p>

        <a href="{{ route('products.index') }}" class="mt-6 inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
            Повернутись до каталогу
        </a>
    </div>
</div>
@endsection
