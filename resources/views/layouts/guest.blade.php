<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SiGudang</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col items-center justify-center px-4 py-8 sm:py-0">
            
            <div class="flex flex-col items-center mb-6 sm:mb-8 text-center">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-2xl shadow-lg flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">SiGudang</h1>
                <p class="text-sm sm:text-base text-gray-500 mt-1">Silakan login untuk melanjutkan</p>
            </div>

            <div class="w-full sm:max-w-md px-6 py-8 sm:px-10 sm:py-10 bg-white shadow-xl rounded-2xl sm:rounded-3xl border border-gray-100">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>