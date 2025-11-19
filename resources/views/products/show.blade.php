@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10">
    <div class="md:flex">
        <div class="md:w-1/2">
            <img class="w-full h-96 object-cover" src="{{ asset($product->image) }}" alt="{{ $product->name }}">
        </div>

        <div class="p-8 md:w-1/2 flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>

                    {{-- ! КНОПКА РЕДАГУВАННЯ (Тільки для адміна) --}}
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('product.edit', $product->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm">
                            ✎ Редагувати
                        </a>
                    @endif
                </div>

                <p class="text-gray-600 mt-4 text-lg">{{ $product->description ?? 'Опис відсутній.' }}</p>
                <div class="mt-6 text-4xl font-bold text-blue-600">{{ $product->price }} ₴</div>
            </div>

            <div class="mt-8">
                {{-- Форма додавання в кошик --}}
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg text-xl font-semibold hover:bg-blue-700 transition shadow-md">
                        Додати в кошик
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <a href="{{ route('products.index') }}" class="text-gray-500 hover:underline">← Повернутись до каталогу</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
