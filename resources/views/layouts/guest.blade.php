<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex bg-gray-100">
        <div class="hidden lg:flex w-1/2 flex-col items-center justify-center p-12 bg-gray-800 text-white text-center">
            <a href="/">
                <img src="{{ asset('images/satpol-logo.png') }}" alt="Logo" class="w-40 h-40 mb-6">
            </a>
            <h1 class="text-3xl font-bold">Sistem Informasi</h1>
            <p class="mt-2 text-gray-300">Selamat datang di portal login Satuan Polisi Pamong Praja.</p>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 sm:p-8">
             <div class="lg:hidden mb-6">
                <a href="/">
                    <img src="{{ asset('images/satpol-logo.png') }}" alt="Logo" class="w-20 h-20">
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>