<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    @vite('resources/css/app.css')
</head>

<header class="bg-white shadow z-40">
    <nav class="flex items-center justify-center p-6 ">
        <div class="flex gap-x-12">
            <a href="/" class="text-sm font-semibold leading-6 text-gray-900">Home</a>
            <a href="/" class="text-sm font-semibold leading-6 text-gray-900">Manufacturers</a>
            <a href="/add-item" class="text-sm font-semibold leading-6 text-gray-900">Add Item</a>
        </div>
    </nav>
</header>
<body>
    <div class="w-full h-screen pt-12 ">
        @yield('content')
    </div>
</body>
