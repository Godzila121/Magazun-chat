@props(['title', 'price', 'image', 'id'])

<div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition">
    <img src="{{ $image }}" alt="{{ $title }}" class="h-48 w-full object-cover mb-4 rounded">
    <h3 class="text-lg font-semibold">{{ $title }}</h3>
    <p class="text-gray-600 mb-4">{{ $price }} ₴</p>

    <form action="{{ route('cart.add', $id) }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
                Додати в кошик
            </button>
        </form>
</div>
