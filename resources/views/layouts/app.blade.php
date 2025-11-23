<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MuseumRakyat - Arsip Budaya Digital')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">

    <style>
        /* Paksa body pakai font Poppins & Background Gelap */
        body { 
            font-family: "Poppins", sans-serif; 
            background-color: #171717; /* Sesuai var(--bg-dark) */
            color: #f5f5f5;
        }

        /* Jarak agar konten tidak tertutup Navbar Fixed */
        main {
            padding-top: 100px; 
            min-height: 80vh;
        }

        /* --- MODIFIKASI BOOTSTRAP AGAR COCOK DENGAN DARK THEME --- */
        
        /* Card menjadi gelap */
        .card {
            background-color: #1f1a17;
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #f5f5f5;
        }
        .card-header {
            background-color: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* Input Form menjadi gelap */
        .form-control, .form-select {
            background-color: #2b2b2b;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .form-control:focus, .form-select:focus {
            background-color: #333;
            color: #fff;
            border-color: #f4c26a; /* Warna Emas */
            box-shadow: 0 0 0 0.25rem rgba(244, 194, 106, 0.25);
        }
        /* Placeholder warna abu */
        .form-control::placeholder { color: #888; }
        
        /* Teks helper form */
        .form-text { color: #aaa; }

        /* Tabel (Dashboard) */
        .table { --bs-table-color: #e0e0e0; --bs-table-bg: transparent; }
        .table-bordered { border-color: rgba(255,255,255,0.1); }
        
        /* Tombol Pagination */
        .page-link { background-color: #1f1a17; border-color: #444; color: #f4c26a; }
        .page-item.active .page-link { background-color: #7b3a10; border-color: #7b3a10; color: #fff; }
    </style>
</head>
<body>

    @include('partials.navbar')

    <main>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show bg-danger text-white border-0" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="{{ asset('js/landing.js') }}"></script>

    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.3.0/model-viewer.min.js"></script>

    @stack('scripts') 
</body>
</html>