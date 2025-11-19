@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Каталог товарів</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($products as $product)
            <x-product-card
                :title="$product->name"
                :price="$product->price"
                :image="$product->image"
                :id="$product->id"
            />
        @endforeach
    </div>
@endsection
