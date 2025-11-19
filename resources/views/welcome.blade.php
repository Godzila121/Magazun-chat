<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Ласкаво просимо</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 h-screen flex items-center justify-center">
    <div class="text-center text-white">
        <h1 class="text-5xl font-bold mb-8">Мій Інтернет-Магазин</h1>
        <p class="text-xl mb-8 text-gray-300">Щоб переглянути товари, будь ласка, авторизуйтесь.</p>

        <div class="space-x-4">
            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-6 rounded-lg transition">
                Увійти
            </a>
            <a href="{{ route('register') }}" class="bg-gray-600 hover:bg-gray-500 text-white font-bold py-3 px-6 rounded-lg transition">
                Зареєструватися
            </a>
        </div>
    </div>
</body>
</html>
