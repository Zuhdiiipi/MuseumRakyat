@extends('layouts.landing')

@section('title', 'Museum Rakyat')

@section('content')

{{-- SECTION HERO --}}
<section class="hero">
    <div class="hero-container">

        <button class="hero-arrow" aria-label="Sebelumnya">&#10094;</button>

        <div class="hero-content-wrapper">
            <h1 class="hero-title">Museum Rakyat</h1>
            <div class="hero-accent"></div>
            <p class="hero-subtitle">
                Telusuri koleksi artefak, tradisi lisan, dan situs budaya dalam bentuk
                foto, model 3D, dan narasi digital.
            </p>

            <div class="hero-actions">
                <a href="#koleksi" class="btn-hero btn-hero-primary">Mulai Jelajahi</a>
                <button class="btn-hero btn-hero-secondary">Unggah Artefak</button>
            </div>
        </div>

        <button class="hero-arrow" aria-label="Berikutnya">&#10095;</button>
    </div>
</section>

{{-- ===================== SECTION KOLEKSI ===================== --}}
<section id="koleksi" class="koleksi-section">
    <div class="koleksi-container">
        <div class="koleksi-header">
            <h2 class="koleksi-title">Jelajahi Koleksi Budaya</h2>
            <p class="koleksi-subtitle">
                Lihat artefak, pusaka, dan benda budaya yang telah didokumentasikan oleh masyarakat dan kurator.
            </p>
        </div>

        <div class="koleksi-grid">

            {{-- Dummy card (nanti berubah jadi @foreach) --}}
            <article class="koleksi-card">
                <div class="koleksi-image-wrapper">
                    <img src="https://via.placeholder.com/400x260?text=Artefak+1" alt="Artefak 1">
                </div>
                <div class="koleksi-body">
                    <h3 class="koleksi-card-title">Salappa Gallang</h3>
                    <p class="koleksi-card-meta">Majene · Sulawesi Barat</p>
                    <p class="koleksi-card-desc">
                        Wadah kapur sirih berbahan kuningan yang digunakan dalam upacara adat oleh kaum bangsawan.
                    </p>
                </div>
            </article>

            <article class="koleksi-card">
                <div class="koleksi-image-wrapper">
                    <img src="https://via.placeholder.com/400x260?text=Artefak+2" alt="Artefak 2">
                </div>
                <div class="koleksi-body">
                    <h3 class="koleksi-card-title">Piring Ceper</h3>
                    <p class="koleksi-card-meta">Polewali Mandar · Sulawesi Barat</p>
                    <p class="koleksi-card-desc">
                        Piring tradisional untuk saji lauk dan kue, sering hadir dalam ritual adat dan jamuan tamu.
                    </p>
                </div>
            </article>

            <article class="koleksi-card">
                <div class="koleksi-image-wrapper">
                    <img src="https://via.placeholder.com/400x260?text=Artefak+3" alt="Artefak 3">
                </div>
                <div class="koleksi-body">
                    <h3 class="koleksi-card-title">Tenun Saqbe</h3>
                    <p class="koleksi-card-meta">Mandar · Sulawesi Barat</p>
                    <p class="koleksi-card-desc">
                        Kain tenun tradisional dengan motif khas Mandar yang merekam jejak identitas kultural.
                    </p>
                </div>
            </article>

        </div>
    </div>
</section>
{{-- ========================= SECTION TENTANG KAMI ========================= --}}
<section id="tentang" class="about-section">
    <div class="about-container">

        {{-- Kolom kiri --}}
        <div class="about-left">
            <h2 class="about-title">Tentang MuseumRakyat</h2>
            <p class="about-subtitle">
                MuseumRakyat adalah platform arsip budaya digital yang didedikasikan
                untuk mendokumentasikan, merawat, dan membagikan kekayaan budaya
                Mandar dan Sulawesi Barat secara terbuka dan kolaboratif.
            </p>

            <p class="about-text">
                Banyak peninggalan budaya Mandar seperti pusaka, artefak, tradisi lisan,
                kuliner, dan situs adat belum terdokumentasi secara digital. Sebagian besar
                hanya diwariskan secara lisan atau tersimpan di komunitas kecil, sehingga
                rentan hilang seiring perubahan zaman.
            </p>

            <p class="about-text">
                MuseumRakyat hadir sebagai ruang digital agar masyarakat, komunitas adat,
                akademisi, dan lembaga kebudayaan dapat berkontribusi langsung melalui
                dokumentasi foto, narasi, dan catatan budaya.
            </p>
        </div>

        {{-- Kolom kanan --}}
        <div class="about-right">
            <div class="about-card">
                <h3 class="about-card-title">Visi</h3>
                <p class="about-card-text">
                    Menjadi gerbang digital utama yang menghubungkan masyarakat dengan warisan
                    budaya Mandar dan Sulawesi Barat secara inklusif, terbuka, dan berkelanjutan.
                </p>
            </div>

            <div class="about-card">
                <h3 class="about-card-title">Misi</h3>
                <ul class="about-list">
                    <li>Mendokumentasikan artefak, tradisi, dan situs budaya melalui teknologi digital.</li>
                    <li>Mengajak masyarakat berperan sebagai kontributor pelestarian budaya.</li>
                    <li>Membangun jejaring kolaborasi antara komunitas adat, sanggar seni, akademisi, dan pemerintah.</li>
                    <li>Menjadikan budaya sebagai sarana edukasi, identitas, dan inspirasi bagi generasi muda.</li>
                </ul>
            </div>

            <div class="about-card">
                <h3 class="about-card-title">Keunggulan</h3>
                <ul class="about-list">
                    <li>Partisipatif — siapa saja dapat mengunggah artefak dan cerita budaya.</li>
                    <li>Terverifikasi — konten dikurasi oleh pakar budaya & komunitas.</li>
                    <li>Berbasis teknologi — mendukung foto, narasi, dan data model digital.</li>
                    <li>Akses publik — gratis untuk pelajar, masyarakat, dan peneliti.</li>
                </ul>
            </div>
        </div>

    </div>
</section>



@endsection