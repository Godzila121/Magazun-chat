<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Ноутбук',
            'description' => 'Потужний ноутбук для роботи',
            'price' => 25000.00,
            'image' => 'https://placehold.co/400x300?text=Laptop' // Тимчасова картинка
        ]);

        Product::create([
            'name' => 'Смартфон',
            'description' => 'Сучасний телефон',
            'price' => 15000.00,
            'image' => 'https://placehold.co/400x300?text=Phone'
        ]);

        Product::create([
            'name' => 'Навушники',
            'description' => 'Бездротові навушники',
            'price' => 3500.00,
            'image' => 'https://placehold.co/400x300?text=Headphones'
        ]);
    }
}

