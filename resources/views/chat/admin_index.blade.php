@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Вхідні повідомлення</h1>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        @foreach($users as $user)
            <a href="{{ route('admin.chat.show', $user->id) }}" class="block p-4 border-b hover:bg-gray-50 transition flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="bg-purple-100 text-purple-600 w-12 h-12 rounded-full flex items-center justify-center font-bold text-xl">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">{{ $user->name }}</h3>
                        <p class="text-gray-500 text-sm">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs">Повідомлень: {{ $user->messages_count }}</span>
                </div>
            </a>
        @endforeach

        @if($users->isEmpty())
            <p class="p-10 text-center text-gray-500">Поки ніхто не писав.</p>
        @endif
    </div>
</div>
@endsection
