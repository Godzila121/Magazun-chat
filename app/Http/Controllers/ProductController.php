<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // <--- Обов'язково додайте це

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Отримуємо всі товари
        return view('products.index', compact('products'));
    }
}
