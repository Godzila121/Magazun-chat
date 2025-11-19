<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Метод для відображення списку товарів (для всіх)
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // --- НОВІ МЕТОДИ ДЛЯ АДМІНА ---

    // 1. Показати сторінку з формою створення (GET)
    public function create()
    {
        return view('products.create');
    }

    // 2. Отримати дані з форми і зберегти їх у базу (POST)
    public function store(Request $request)
    {
        // Валідація: перевіряємо, чи заповнені поля правильно
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // фото обов'язкове, макс 2Мб
        ]);

        // Завантаження картинки на сервер
        // Формуємо унікальне ім'я (час + розширення)
        $imageName = time().'.'.$request->image->extension();

        // Переміщуємо файл у папку public/images
        $request->image->move(public_path('images'), $imageName);

        // Створення запису в Базі Даних
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            // Зберігаємо шлях відносно папки public
            'image' => 'images/' . $imageName,
        ]);

        // Повертаємось на головну з повідомленням
        return redirect()->route('products.index')->with('success', 'Товар успішно створено!');
    }
public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Видаляємо файл картинки з диска, щоб не займати місце (опціонально)
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete(); // Видаляємо запис з БД

        return redirect()->route('products.index')->with('success', 'Товар успішно видалено!');
    }
}
