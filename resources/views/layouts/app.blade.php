<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow mb-8 p-4">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('products.index') }}" class="text-xl font-bold text-blue-600">MyShop</a>
            <a href="#" class="text-gray-600">Кошик (0)</a> </div>
    </nav>

    <main class="container mx-auto px-4">
        @yield('content')
    </main>
</body>
</html>
