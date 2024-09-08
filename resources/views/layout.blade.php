<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    @vite('resources/css/app.css')
</head>

<header class="bg-white shadow">
    <nav class="flex items-center justify-center p-6 lg:px-8">
        <div class="flex gap-x-12">
            <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Home</a>
            <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Review</a>
            <a href="#" class="text-sm font-semibold leading-6 text-gray-900">NewItem</a>
        </div>
    </nav>
</header>

<div class="container">
    @yield('content')
</div>
