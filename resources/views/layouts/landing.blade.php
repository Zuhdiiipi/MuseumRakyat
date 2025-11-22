<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Museum Rakyat')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- CSS Landing --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>
    @include('partials.footer')  
    {{-- JS Landing --}}
    <script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>
