<header class="site-navbar">
    <div class="navbar-container">
        <div class="navbar-left">
            <a href="{{ url('/') }}" class="navbar-logo">
                <img src="{{ asset('images/logo-museumrakyatnobg.png') }}" alt="Logo Museum Rakyat">
            </a>

            {{-- MENU DESKTOP --}}
            <nav class="navbar-menu desktop-only">
                <a href="{{ url('/') }}" class="navbar-link active">Home</a>
                <a href="#koleksi" class="navbar-link">Jelajahi Koleksi</a>
                <a href="#peta" class="navbar-link">Peta Budaya</a>
                <a href="#tentang" class="navbar-link">Tentang Kami</a>
            </nav>
        </div>

        {{-- TOMBOL KANAN DESKTOP --}}
        <div class="navbar-right desktop-only">
            @auth
                {{-- Kalau user sudah login --}}
                <a href="{{ route('dashboard') }}" class="btn-nav btn-nav-login">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-nav btn-nav-signup">
                        Logout
                    </button>
                </form>
            @else
                {{-- Kalau user belum login --}}
                <a href="{{ route('login') }}" class="btn-nav btn-nav-login">
                    Login
                </a>
                <a href="{{ route('register') }}" class="btn-nav btn-nav-signup">
                    Sign Up
                </a>
            @endauth
        </div>

        {{-- HAMBURGER MOBILE --}}
        <button class="hamburger mobile-only" id="hamburgerBtn" type="button" aria-label="Buka menu navigasi">
            ☰
        </button>
    </div>
</header>

{{-- MOBILE DRAWER MENU --}}
<div class="mobile-menu-backdrop" id="mobileBackdrop"></div>

<aside class="mobile-menu" id="mobileMenu" aria-label="Menu navigasi seluler">
    <div class="mobile-menu-header">
        <span class="mobile-menu-title">Menu</span>
        <button class="mobile-menu-close" id="mobileCloseBtn" type="button" aria-label="Tutup menu navigasi">
            ✕
        </button>
    </div>

    <nav class="mobile-menu-links">
        <a href="{{ url('/') }}" class="mobile-link">Home</a>
        <a href="#koleksi" class="mobile-link">Jelajahi Koleksi</a>
        <a href="#peta" class="mobile-link">Peta Budaya</a>
        <a href="#tentang" class="mobile-link">Tentang Kami</a>
    </nav>

    <div class="mobile-menu-actions">
        @auth
            <a href="{{ route('dashboard') }}" class="btn-nav btn-nav-login">
                Dashboard
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn-nav btn-nav-signup" type="submit">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn-nav btn-nav-login">
                Login
            </a>
            <a href="{{ route('register') }}" class="btn-nav btn-nav-signup">
                Sign Up
            </a>
        @endauth
    </div>
</aside>
