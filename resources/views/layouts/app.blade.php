<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel Shop') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script> {{-- Додатковий CDN про всяк випадок --}}
    </head>
    <body class="font-sans antialiased bg-gray-100">

        {{-- НАВІГАЦІЯ --}}
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('products.index') }}" class="text-2xl font-bold text-blue-600">
                                MyShop
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">

                        {{-- Посилання на Кошик (Бачать усі) --}}
                        <a href="{{ route('cart.index') }}" class="flex items-center text-gray-600 hover:text-blue-600 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Кошик
                            <span class="ml-1 bg-red-500 text-white rounded-full text-xs px-2 py-0.5">
                                {{ count(session('cart', [])) }}
                            </span>
                        </a>

                        {{-- Логіка Авторизації --}}
                        @auth
                            {{-- Якщо користувач увійшов --}}

                            {{-- Кнопка адміна (Тільки якщо is_admin = true) --}}
                            @if(Auth::user()->is_admin)
                                <a href="{{ route('product.create') }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                    + Додати товар
                                </a>
                            @endif

                            <div class="ml-3 relative flex items-center">
                                <span class="mr-2 text-gray-500 text-sm">{{ Auth::user()->name }}</span>

                                {{-- Кнопка Виходу --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-800 underline">
                                        Вийти
                                    </button>
                                </form>
                            </div>
                        @else
                            {{-- Якщо гість --}}
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-blue-600 underline">Вхід</a>
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 hover:text-blue-600 underline">Реєстрація</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="py-6 px-4 sm:px-6 lg:px-8">
            {{-- ВАЖЛИВО: ми використовуємо yield, щоб працювали наші попередні шаблони --}}
            @yield('content')

            {{-- Підтримка Breeze компонентів, якщо десь використовуються --}}
            {{ $slot ?? '' }}
        </main>
    {{-- Кнопка чату --}}
    @auth
        @if(auth()->user()->is_admin)
            {{-- Кнопка для Адміна веде до списку діалогів --}}
            <a href="{{ route('admin.chat.index') }}" class="fixed bottom-5 right-5 bg-purple-600 text-white p-4 rounded-full shadow-lg hover:bg-purple-700 transition flex items-center justify-center z-50" title="Повідомлення клієнтів">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                </svg>
            </a>
        @else
            {{-- Кнопка для Клієнта веде в його чат --}}
            <a href="{{ route('chat.index') }}" class="fixed bottom-5 right-5 bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 transition flex items-center justify-center z-50" title="Написати підтримці">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
            </a>
        @endif
    @endauth
    </body>
</html>
