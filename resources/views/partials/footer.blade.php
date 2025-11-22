<footer class="site-footer">
    {{-- Bagian atas footer --}}
    <div class="footer-top">
        <div class="footer-container">

            {{-- Brand / Logo --}}
            <div class="footer-col footer-brand">
                <div class="footer-logo">
                    <img src="{{ asset('images/logo-museumrakyatnobg.png') }}" alt="Logo MuseumRakyat">
                </div>
                <h3 class="footer-brand-name">MuseumRakyat</h3>
                <p class="footer-text">
                    Platform arsip digital untuk mendokumentasikan dan membagikan
                    kekayaan budaya Mandar dan Sulawesi Barat secara kolaboratif,
                    terbuka, dan mudah diakses.
                </p>
            </div>

            {{-- Navigasi --}}
            <div class="footer-col">
                <h4 class="footer-title">Jelajah</h4>
                <ul class="footer-list">
                    <li><a href="{{ url('/') }}#koleksi">Koleksi Budaya</a></li>
                    <li><a href="{{ url('/') }}#peta">Peta Budaya</a></li>
                    <li><a href="{{ url('/') }}#tentang">Tentang Kami</a></li>
                </ul>
            </div>

            {{-- Quick Links --}}
            <div class="footer-col">
                <h4 class="footer-title">Tautan</h4>
                <ul class="footer-list">
                    <li><a href="#">Panduan Kontributor</a></li>
                    <li><a href="#">Kebijakan Data</a></li>
                    <li><a href="#">Kolaborasi & Kemitraan</a></li>
                </ul>
            </div>

            {{-- Kontak & Sosial --}}
            <div class="footer-col">
                <h4 class="footer-title">Kontak</h4>
                <ul class="footer-list">
                    <li>Sulawesi Barat, Indonesia</li>
                    <li><a href="mailto:info@museumrakyat.id">info@museumrakyat.id</a></li>
                </ul>

                <div class="footer-social">
                    <span class="footer-social-label">Ikuti Kami</span>
                    <div class="footer-social-links">
                        <a href="#" aria-label="Instagram">IG</a>
                        <a href="#" aria-label="YouTube">YT</a>
                        <a href="#" aria-label="Komunitas">Forum</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Bagian bawah footer --}}
    <div class="footer-bottom">
        <div class="footer-bottom-inner">
            <p>© {{ date('Y') }} MuseumRakyat. Semua hak dilindungi.</p>
            <button class="footer-top-btn" id="scrollTopBtn">
                Kembali ke atas ↑
            </button>
        </div>
    </div>
</footer>
