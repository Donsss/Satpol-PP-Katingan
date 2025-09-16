<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satpol PP</title>
    <link rel="icon" type="image/png" href="{{ asset('images/satpol-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @vite(['resources/js/app.js'])

    @stack('styles')
</head>
<body>

    <x-user-components.header></x-user-components.header>
    <main>
        {{ $slot }}
    </main>
    <x-user-components.footer></x-user-components.footer>

    @stack('scripts')
    
</body>
</html>