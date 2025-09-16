<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Satpol PP</title>
        <link rel="icon" type="image/png" href="{{ asset('images/satpol-logo.png') }}">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.sidebar')

            <div class="md:ml-64">
                @isset($header)
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset
                
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sidebar = document.querySelector('nav');
                const content = document.querySelector('.content');
                const toggleBtn = document.getElementById('sidebar-toggle');
                
                if (toggleBtn) {
                    toggleBtn.addEventListener('click', function() {
                        sidebar.classList.toggle('-translate-x-full');
                        content.classList.toggle('ml-0');
                        content.classList.toggle('ml-64');
                    });
                }
            });
        </script>
    </body>
</html>