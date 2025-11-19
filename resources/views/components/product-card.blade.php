@props(['title', 'price', 'image', 'id'])

<div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition relative group h-full flex flex-col justify-between">
    <div>
        {{-- Клікабельне зображення --}}
        <a href="{{ route('products.show', $id) }}">
            <img src="{{ asset($image) }}" alt="{{ $title }}" class="h-48 w-full object-cover mb-4 rounded cursor-pointer">
        </a>

        {{-- Клікабельна назва --}}
        <a href="{{ route('products.show', $id) }}">
            <h3 class="text-lg font-semibold hover:text-blue-600 cursor-pointer">{{ $title }}</h3>
        </a>

        <p class="text-gray-600 mb-4">{{ $price }} ₴</p>
    </div>

    <div>
        {{-- Форма додавання в кошик --}}
        <form action="{{ route('cart.add', $id) }}" method="POST" class="mb-2">
            @csrf
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
                Додати в кошик
            </button>
        </form>

        {{-- Кнопка видалення (ТІЛЬКИ ДЛЯ АДМІНА) --}}
        @if(auth()->check() && auth()->user()->is_admin)
            <form action="{{ route('product.destroy', $id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цей товар?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-100 text-red-600 py-1 rounded hover:bg-red-600 hover:text-white transition text-sm border border-red-200">
                    🗑 Видалити товар
                </button>
            </form>
        @endif
    </div>
</div>
