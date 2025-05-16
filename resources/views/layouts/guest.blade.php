<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex bg-gray-100">
            <!-- Left side - Content -->
            <div class="w-1/2 flex items-center flex-col justify-center bg-yellow-500">
            
                <a href="/">
                    <x-application-logo class="w-32 h-32 fill-current text-white" />
                </a>
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-white">Selamat Datang di Aplikasi PPPJ!</h1>
                    <p class="mt-2 text-lg text-gray-200">Perumda Pasar Pakuan Jaya.</p>
                </div>
            </div>
            
            <!-- Right side - Logo -->
            <div class="w-1/2 flex items-center justify-center">
                <div class="w-full max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
