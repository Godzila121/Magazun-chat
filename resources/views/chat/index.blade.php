@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow rounded-lg overflow-hidden">
    <div class="bg-blue-600 p-4 text-white">
        <h1 class="text-xl font-bold">Чат з магазином</h1>
    </div>

    {{-- Область повідомлень --}}
    <div class="p-4 h-96 overflow-y-auto bg-gray-50 flex flex-col gap-3">
        @forelse($messages as $msg)
            <div class="{{ $msg->is_admin ? 'self-start bg-gray-200 text-gray-800' : 'self-end bg-blue-500 text-white' }} p-3 rounded-lg max-w-xs">
                <p>{{ $msg->message }}</p>
                <span class="text-xs opacity-70 block text-right mt-1">{{ $msg->created_at->format('H:i') }}</span>
            </div>
        @empty
            <p class="text-center text-gray-400 mt-10">Поки немає повідомлень. Напишіть нам!</p>
        @endforelse
    </div>

    {{-- Форма відправки --}}
    <form action="{{ route('chat.store') }}" method="POST" class="p-4 border-t flex gap-2">
        @csrf
        <input type="text" name="message" class="flex-1 border p-2 rounded" placeholder="Введіть повідомлення..." required autofocus>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Надіслати</button>
    </form>
</div>
@endsection
