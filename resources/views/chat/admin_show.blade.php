@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow rounded-lg overflow-hidden">
    <div class="bg-purple-600 p-4 text-white flex justify-between items-center">
        <h1 class="text-xl font-bold">Чат з: {{ $user->name }}</h1>
        <a href="{{ route('admin.chat.index') }}" class="text-sm underline hover:text-gray-200">Назад до списку</a>
    </div>

    {{-- Область повідомлень --}}
    <div class="p-4 h-96 overflow-y-auto bg-gray-50 flex flex-col gap-3">
        @foreach($messages as $msg)
            {{-- Логіка кольорів для Адміна: Мої (Admin) - справа/кольорові, Юзера - зліва/сірі --}}
            <div class="{{ $msg->is_admin ? 'self-end bg-purple-600 text-white' : 'self-start bg-gray-200 text-gray-800' }} p-3 rounded-lg max-w-xs">
                <p>{{ $msg->message }}</p>
                <span class="text-xs opacity-70 block text-right mt-1">{{ $msg->created_at->format('H:i') }}</span>
            </div>
        @endforeach
    </div>

    {{-- Форма відправки --}}
    <form action="{{ route('admin.chat.store', $user->id) }}" method="POST" class="p-4 border-t flex gap-2">
        @csrf
        <input type="text" name="message" class="flex-1 border p-2 rounded" placeholder="Відповісти клієнту..." required autofocus>
        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Надіслати</button>
    </form>
</div>
@endsection
