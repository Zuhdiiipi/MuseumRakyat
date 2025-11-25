<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>403 - Akses Ditolak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- load css --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body class="error-403">

    <div class="error-watermark"></div>
    <div class="error-glow"></div>

    <div class="error-container">
        <div class="error-card">

            <div class="error-pill">
                <span class="error-pill-dot"></span>
                <span>Keamanan Akses · MuseumRakyat</span>
            </div>

            <div class="error-code">403</div>
            <div class="error-subtitle">Access restricted</div>
            <div class="error-title">Akses ke halaman ini ditolak</div>

            <p class="error-desc">
                Halaman ini hanya dapat dibuka oleh pengguna yang memiliki hak akses tertentu.
                Jika ini bukan seharusnya, hubungi administrator sistem MuseumRakyat.
            </p>

            <div class="error-actions">
                <a href="{{ url('/') }}" class="btn btn-primary">
                    ⬅ Kembali ke Beranda
                </a>

                @auth
                    @if (Route::has('dashboard'))
                        <a href="{{ route('dashboard') }}" class="btn btn-outline">
                            🏛 Buka Dashboard
                        </a>
                    @endif
                @endauth
            </div>

            <div class="error-toggle" onclick="document.querySelector('.error-detail').classList.toggle('show')">
                Lihat detail teknis error
            </div>

            <div class="error-detail">
                Kode kesalahan: <strong>HTTP 403 Forbidden</strong>.<br>
                Permintaan berhasil diterima server,
                tetapi akun tidak memiliki izin untuk membuka resource ini.
            </div>

            <div class="error-credit">
                MuseumRakyat · Sistem Informasi Kebudayaan Indonesia
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') window.location.href = "{{ url('/') }}";
        });
    </script>

</body>
</html>
