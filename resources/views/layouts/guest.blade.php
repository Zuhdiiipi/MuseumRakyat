<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Museum Rakyat') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tambahkan CSS tema Museum Rakyat -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body class="auth-body">
    <div class="auth-container">
        <div class="auth-card">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
