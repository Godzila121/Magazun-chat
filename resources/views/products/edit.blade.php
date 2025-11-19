@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow mt-10">
    <h2 class="text-2xl font-bold mb-6 border-b pb-2">Редагування товару: {{ $product->name }}</h2>

    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- ! ВАЖЛИВО: HTML форми підтримують тільки GET/POST, тому емулюємо PUT --}}

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Назва товару</label>
            <input type="text" name="name" value="{{ $product->name }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Ціна (грн)</label>
            <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Опис</label>
            <textarea name="description" rows="5" class="w-full border p-2 rounded">{{ $product->description }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Зображення (залиште пустим, якщо не змінюєте)</label>
            <div class="mb-2">
                <img src="{{ asset($product->image) }}" class="h-20 rounded border">
            </div>
            <input type="file" name="image" class="w-full border p-2 rounded">
        </div>

        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('products.show', $product->id) }}" class="text-gray-500 hover:underline">Скасувати</a>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 font-bold">
                Зберегти зміни
            </button>
        </div>
    </form>
</div>
@endsection
