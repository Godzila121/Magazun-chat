@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Мій кошик</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(empty($cart))
            <div class="text-center py-10">
                <p class="text-xl text-gray-500 mb-4">Ваш кошик порожній.</p>
                <a href="{{ route('products.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Повернутись до покупок
                </a>
            </div>
        @else
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-4 border-b">Товар</th>
                            <th class="p-4 border-b">Ціна</th>
                            <th class="p-4 border-b">Кількість</th>
                            <th class="p-4 border-b">Сума</th>
                            <th class="p-4 border-b">Дії</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 border-b flex items-center">
                                <img src="{{ $item['image'] }}" class="w-12 h-12 object-cover rounded mr-4">
                                <span class="font-semibold">{{ $item['name'] }}</span>
                            </td>
                            <td class="p-4 border-b">{{ $item['price'] }} ₴</td>
                            <td class="p-4 border-b">{{ $item['quantity'] }}</td>
                            <td class="p-4 border-b font-bold">{{ $item['price'] * $item['quantity'] }} ₴</td>
                            <td class="p-4 border-b">
                                <a href="{{ route('cart.remove', $id) }}" class="text-red-500 hover:text-red-700 text-sm">
                                    Видалити
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-4 bg-gray-50 border-t flex justify-between items-center">
                    {{-- Кнопка очищення кошика (через форму, бо це POST запит) --}}
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-600 hover:underline text-sm">
                            Очистити кошик
                        </button>
                    </form>

                    <div class="text-right">
                        <span class="text-xl font-bold block">Загалом: {{ $total }} ₴</span>
                        <a href="{{ route('order.checkout') }}" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 inline-block">
                            Оформити замовлення
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
