<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
    // --- КЛІЄНТСЬКА ЧАСТИНА ---

    // Показати чат поточного користувача
    public function index()
    {
        // Беремо повідомлення, де user_id = поточний юзер
        $messages = Message::where('user_id', auth()->id())->orderBy('created_at', 'asc')->get();
        return view('chat.index', compact('messages'));
    }

    // Надіслати повідомлення (від клієнта)
    public function store(Request $request)
    {
        $request->validate(['message' => 'required']);

        Message::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
            'is_admin' => false, // Це пише клієнт
        ]);

        return redirect()->back();
    }

    // --- АДМІНСЬКА ЧАСТИНА ---

    // Список всіх діалогів (хто писав адміну)
    public function adminIndex()
    {
        // Знаходимо користувачів, які мають хоча б одне повідомлення
        $users = User::whereHas('messages')->withCount('messages')->get();
        return view('chat.admin_index', compact('users'));
    }

    // Чат з конкретним юзером
    public function adminShow($userId)
    {
        $user = User::findOrFail($userId);
        $messages = Message::where('user_id', $userId)->orderBy('created_at', 'asc')->get();

        return view('chat.admin_show', compact('user', 'messages'));
    }

    // Відповідь адміна
    public function adminStore(Request $request, $userId)
    {
        $request->validate(['message' => 'required']);

        Message::create([
            'user_id' => $userId, // Прив'язуємо до того юзера, з ким говоримо
            'message' => $request->message,
            'is_admin' => true, // Це пише Адмін
        ]);

        return redirect()->back();
    }
}
