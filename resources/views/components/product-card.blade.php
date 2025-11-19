@props(['title', 'price', 'image', 'id'])

<div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition relative group">
    <img src="{{ asset($image) }}" alt="{{ $title }}" class="h-48 w-full object-cover mb-4 rounded">
    <h3 class="text-lg font-semibold">{{ $title }}</h3>
    <p class="text-gray-600 mb-4">{{ $price }} ₴</p>

    {{-- Форма покупки --}}
    <form action="{{ route('cart.add', $id) }}" method="POST" class="mb-2">
        @csrf
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
            Додати в кошик
        </button>
    </form>

    {{-- Блок видалення (ТІЛЬКИ ДЛЯ АДМІНА) --}}
    @if(auth()->check() && auth()->user()->is_admin)
        <form action="{{ route('product.destroy', $id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цей товар?');">
            @csrf
            @method('DELETE') {{-- Ця директива перетворює POST запит на DELETE --}}

            <button type="submit" class="w-full bg-red-100 text-red-600 py-1 rounded hover:bg-red-600 hover:text-white transition text-sm border border-red-200">
                🗑 Видалити товар
            </button>
        </form>
    @endif
</div>
