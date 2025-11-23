@extends('layouts.landing')

@section('title', 'Museum Rakyat')

@section('content')

    {{-- SECTION HERO --}}
<section class="hero reveal" data-reveal>
    <div class="hero-container">

        <button class="hero-arrow hero-arrow-left" aria-label="Sebelumnya">
            &#10094;
        </button>

        <div class="hero-content-wrapper">
            <span class="hero-kicker">
                Arsip Budaya Digital · Mandar & Sulawesi Barat
            </span>

            <h1 class="hero-title">Museum Rakyat</h1>
            <div class="hero-accent"></div>

            <p class="hero-subtitle">
                Telusuri koleksi artefak, tradisi lisan, dan situs budaya dalam bentuk
                foto, dokumentasi audio visual, hingga model 3D yang dapat diakses semua orang.
            </p>

            <div class="hero-actions">
                <a href="#koleksi" class="btn-hero btn-hero-primary">
                    Mulai Jelajahi Koleksi
                </a>
                <button class="btn-hero btn-hero-secondary" type="button">
                    Unggah Artefak & Cerita
                </button>
            </div>

            <div class="hero-meta">
                <div class="hero-meta-item">
                    <span class="hero-meta-number">120+</span>
                    <span class="hero-meta-label">Artefak Terdokumentasi</span>
                </div>
                <div class="hero-meta-item">
                    <span class="hero-meta-number">15</span>
                    <span class="hero-meta-label">Komunitas Kontributor</span>
                </div>
                <div class="hero-meta-item">
                    <span class="hero-meta-number">8</span>
                    <span class="hero-meta-label">Kabupaten/Kota Terwakili</span>
                </div>
            </div>
        </div>

        <button class="hero-arrow hero-arrow-right" aria-label="Berikutnya">
            &#10095;
        </button>
    </div>
</section>


    {{-- ===================== SECTION KOLEKSI ===================== --}}
<section id="koleksi" class="koleksi-section reveal" data-reveal>
    <div class="koleksi-container">
        <div class="koleksi-header">
            <div class="koleksi-header-top">
                <div>
                    <span class="section-kicker">Koleksi Digital</span>
                    <h2 class="koleksi-title">Jelajahi Koleksi Budaya</h2>
                </div>

                {{-- optional: ganti "#" dengan route() kalau sudah ada halaman daftar --}}
                <a href="#" class="koleksi-link-all">
                    Lihat semua koleksi
                    <span class="koleksi-link-icon">↗</span>
                </a>
            </div>

            <p class="koleksi-subtitle">
                Lihat artefak, pusaka, dan benda budaya yang telah didokumentasikan oleh masyarakat dan kurator.
            </p>
        </div>

        <div class="koleksi-grid">

            {{-- Dummy card (nanti berubah jadi @foreach) --}}
            <article class="koleksi-card">
                <div class="koleksi-image-wrapper">
                    <img src="images/1.jpg" alt="Artefak 1">
                </div>
                <div class="koleksi-body">
                    <span class="koleksi-chip">Benda Pusaka</span>
                    <h3 class="koleksi-card-title">Salappa Gallang</h3>
                    <p class="koleksi-card-meta">Majene · Sulawesi Barat</p>
                    <p class="koleksi-card-desc">
                        Wadah kapur sirih berbahan kuningan yang digunakan dalam upacara adat oleh kaum bangsawan.
                    </p>
                </div>
            </article>

            <article class="koleksi-card">
                <div class="koleksi-image-wrapper">
                    <img src="images/2.jpg" alt="Artefak 2">
                </div>
                <div class="koleksi-body">
                    <span class="koleksi-chip">Peralatan</span>
                    <h3 class="koleksi-card-title">Piring Ceper</h3>
                    <p class="koleksi-card-meta">Polewali Mandar · Sulawesi Barat</p>
                    <p class="koleksi-card-desc">
                        Piring tradisional untuk saji lauk dan kue, sering hadir dalam ritual adat dan jamuan tamu.
                    </p>
                </div>
            </article>

            <article class="koleksi-card">
                <div class="koleksi-image-wrapper">
                    <img src="images/3.jpg" alt="Artefak 3">
                </div>
                <div class="koleksi-body">
                    <span class="koleksi-chip">Tekstil</span>
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

{{-- ===================== SECTION PETA ===================== --}}
<section id="peta" class="map-section">
    <div class="map-container">
        <h2 class="map-title">Peta Persebaran Museum di Sulawesi Barat</h2>
        <p class="map-subtitle">
            Cek lokasi museum, situs sejarah, dan sanggar seni dalam satu tampilan peta digital.
        </p>

        <div id="museumMap"></div>
    </div>
</section>

<!-- SCRIPT PEMETAAN -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const map = L.map('museumMap').setView([-2.5, 119.3], 7); // fokus Sulbar

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    // === CUSTOM ICON MUSEUM ===
    const museumIcon = L.icon({
        iconUrl: "{{ asset('images/map/museum-icon.png') }}",
        iconSize: [64, 64],      // diperbesar dulu biar jelas
        iconAnchor: [32, 64],
        popupAnchor: [0, -56],
    });

    // === TEST: 1 MARKER STATIS DI TENGAH, TANPA API ===
    L.marker([-2.5, 119.3], { icon: museumIcon })
        .addTo(map)
        .bindPopup('<strong>Museum mandar majene</strong>');
});
</script>



    {{-- ========================= SECTION TENTANG KAMI ========================= --}}
    <section id="tentang" class="about-section reveal" data-reveal>
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

        {{-- ========================= SECTION TIM PROJECT ========================= --}}
    <section id="tim" class="team-section reveal" data-reveal>
    <div class="team-container">
        <div class="team-header">
            <h2 class="team-title">Tim di Balik MuseumRakyat</h2>
            <p class="team-subtitle">
                Orang-orang hebat yang berkolaborasi untuk menghadirkan arsip budaya Mandar
                dan Sulawesi Barat ke ruang digital.
            </p>

            <div class="team-filters" aria-label="Filter berdasarkan fokus tim">
                <button class="team-filter-chip active" data-team-filter="all">Semua</button>
                <button class="team-filter-chip" data-team-filter="pimpinan">Pimpinan</button>
                <button class="team-filter-chip" data-team-filter="administrasi">Administrasi</button>
                <button class="team-filter-chip" data-team-filter="konten">Konten</button>
                <button class="team-filter-chip" data-team-filter="backend">Backend</button>
                <button class="team-filter-chip" data-team-filter="frontend">Frontend</button>
            </div>
        </div>

        <div class="team-grid">

            <!-- Armawan -->
            <article class="team-card" data-team-role="pimpinan">
                <div class="team-card-inner">
                    <div class="team-avatar-wrapper">
                        <img src="images/armawan.jpg" alt="Armawan">
                        <span class="team-role-chip">Ketua Tim</span>
                    </div>
                    <div class="team-body">
                        <h3 class="team-name">Armawan</h3>
                        <p class="team-position">Ketua Tim</p>
                        <p class="team-bio">
                            Ahli Budaya dan Mengkoordinasi seluruh tim, memastikan keberlangsungan proyek, dan arah strategis MuseumRakyat.
                        </p>
                    </div>
                </div>
            </article>

            <!-- Nur Avika -->
            <article class="team-card" data-team-role="administrasi">
                <div class="team-card-inner">
                    <div class="team-avatar-wrapper">
                        <img src="" alt="Nur Avika">
                        <span class="team-role-chip">Administrasi & Dokumentasi</span>
                    </div>
                    <div class="team-body">
                        <h3 class="team-name">Nur Avika</h3>
                        <p class="team-position">Dokumentasi & Administrasi</p>
                        <p class="team-bio">
                            Mengelola dokumentasi proyek, pengarsipan kegiatan, dan administrasi pendukung pengembangan MuseumRakyat.
                        </p>
                    </div>
                </div>
            </article>

            <!-- Greis Banne Liling -->
            <article class="team-card" data-team-role="konten">
                <div class="team-card-inner">
                    <div class="team-avatar-wrapper">
                        <img src="images/grace.jpg" alt="Greis Banne Liling">
                        <span class="team-role-chip">Content & Community</span>
                    </div>
                    <div class="team-body">
                        <h3 class="team-name">Greis Banne Liling</h3>
                        <p class="team-position">Content & Community Coordinator</p>
                        <p class="team-bio">
                            Merancang strategi konten, membangun keterlibatan komunitas, dan mengelola narasi budaya MuseumRakyat.
                        </p>
                    </div>
                </div>
            </article>

            <!-- Muhammad Zuhdi -->
            <article class="team-card" data-team-role="backend">
                <div class="team-card-inner">
                    <div class="team-avatar-wrapper">
                        <img src="images/zuhdi.png" alt="Muhammad Zuhdi">
                        <span class="team-role-chip">Backend Developer</span>
                    </div>
                    <div class="team-body">
                        <h3 class="team-name">Muhammad Zuhdi</h3>
                        <p class="team-position">Backend Developer & Database Engineer</p>
                        <p class="team-bio">
                            Merancang database, API backend, dan memastikan keandalan alur data dalam sistem MuseumRakyat.
                        </p>
                        <div class="team-tags">
                            <span class="team-tag">Laravel</span>
                            <span class="team-tag">Database</span>
                            <span class="team-tag">API</span>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Muhammad Naufal N -->
            <article class="team-card" data-team-role="frontend">
                <div class="team-card-inner">
                    <div class="team-avatar-wrapper">
                        <img src="images/Nopal.jpg" alt="Muhammad Naufal N">
                        <span class="team-role-chip">Frontend Developer</span>
                    </div>
                    <div class="team-body">
                        <h3 class="team-name">Muhammad Naufal. N</h3>
                        <p class="team-position">Frontend Developer & UI/UX Designer</p>
                        <p class="team-bio">
                            Mengembangkan antarmuka pengguna yang estetik dan responsif sekaligus pengalaman interaksi yang nyaman.
                        </p>
                        <div class="team-tags">
                            <span class="team-tag">UI/UX</span>
                            <span class="team-tag">Frontend</span>
                            <span class="team-tag">Animation</span>
                        </div>
                    </div>
                </div>
            </article>

        </div>
    </div>
</section>


@endsection
