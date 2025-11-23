<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Museum Rakyat')</title>

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- CSS Landing --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

</head>
<body>

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- CONTENT WRAPPER --}}
    <main>
        @yield('content')
    </main>

     @include('partials.footer')
    {{-- JS Landing --}}
    <script src="{{ asset('js/landing.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

</body>
</html>
