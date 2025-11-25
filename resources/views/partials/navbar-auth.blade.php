<header class="site-navbar">
    <div class="navbar-container">
        <div class="navbar-left">
            <a href="{{ route('home') }}" class="navbar-logo">
                <img src="{{ asset('images/logo-museumrakyatnobg.png') }}" alt="Logo">
            </a>

            <nav class="navbar-menu desktop-only">
                <a href="{{ route('home') }}" class="navbar-link">Home</a>
                <a href="{{ route('museums.index') }}" class="navbar-link">Peta Budaya</a>
                <a href="{{ route('artifacts.index') }}" class="navbar-link">Galeri Koleksi</a>
                <a href="{{ url('/') }}#tentang" class="navbar-link">Tentang Kami</a>
            </nav>
        </div>

        <div class="navbar-right desktop-only">

            {{-- JIKA BELUM LOGIN (Tamu) --}}
            @guest
                <a href="{{ route('login') }}" class="btn-nav btn-nav-login text-decoration-none">Login</a>
                <a href="{{ route('register') }}" class="btn-nav btn-nav-signup text-decoration-none">Sign Up</a>
            @endguest

            {{-- JIKA SUDAH LOGIN (Member) --}}
            @auth
                {{-- 1. Tombol Upload --}}
                <a href="{{ route('artifacts.create') }}" class="btn-nav btn-nav-login d-flex align-items-center gap-2 text-decoration-none">
                    <span>+ Upload</span>
                </a>

                {{-- 2. Dropdown User --}}
                <div class="dropdown ms-2">
                    <button class="btn-nav btn-nav-signup dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        
                        {{-- Foto Profil --}}
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="rounded-circle" style="width: 24px; height: 24px; object-fit: cover; border: 1px solid #fff;">
                        @else
                            <span class="bi bi-person-circle"></span>
                        @endif
                        
                        {{-- Nama User --}}
                        {{ Str::limit(Auth::user()->name, 10) }}
                    </button>
                    
                    {{-- ISI MENU DROPDOWN --}}
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow-lg mt-2 border-secondary">
                        <li><h6 class="dropdown-header text-warning">Halo, {{ Auth::user()->name }}!</h6></li>
                        
                        {{-- Menu: Edit Profil --}}
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                👤 Edit Profil
                            </a>
                        </li>

                        {{-- Menu: Dashboard / Arsip --}}
                        <li>
                            @if(Auth::user()->role === 'ADMIN' || Auth::user()->role === 'CURATOR')
                                <a class="dropdown-item" href="{{ route('curator.index') }}">
                                    👮 Dashboard Kurator
                                </a>
                            @else
                                <a class="dropdown-item" href="{{ route('artifacts.my_archive') }}">
                                    📂 Arsip Saya
                                </a>
                            @endif
                        </li>

                        <li><hr class="dropdown-divider border-secondary"></li>
                        
                        {{-- Menu: Logout --}}
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    🚪 Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

        </div>

        {{-- Hamburger Mobile --}}
        <button class="hamburger mobile-only" id="hamburgerBtn">☰</button>
    </div>
</header>

{{-- MENU MOBILE (SAMA PENTINGNYA UNTUK HP) --}}
<div class="mobile-menu-backdrop" id="mobileBackdrop"></div>
<aside class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-header">
        <span class="mobile-menu-title">Menu</span>
        <button class="mobile-menu-close" id="mobileCloseBtn">✕</button>
    </div>

    <nav class="mobile-menu-links">
        <a href="{{ route('home') }}" class="mobile-link">Home</a>
        <a href="{{ route('museums.index') }}" class="mobile-link">Peta Budaya</a>
        <a href="{{ route('artifacts.index') }}" class="mobile-link">Galeri Koleksi</a>

        <hr class="border-secondary my-2">

        @guest
            <a href="{{ route('login') }}" class="mobile-link">Login</a>
            <a href="{{ route('register') }}" class="mobile-link">Sign Up</a>
        @endguest

        @auth
            <span class="text-muted small px-2">Akun: {{ Auth::user()->name }}</span>
            
            <a href="{{ route('profile.edit') }}" class="mobile-link">👤 Edit Profil</a>
            <a href="{{ route('artifacts.create') }}" class="mobile-link text-warning">+ Upload Koleksi</a>

            @if(Auth::user()->role === 'ADMIN' || Auth::user()->role === 'CURATOR')
                <a href="{{ route('curator.index') }}" class="mobile-link">👮 Dashboard Kurator</a>
            @else
                <a href="{{ route('artifacts.my_archive') }}" class="mobile-link">📂 Arsip Saya</a>
            @endif

            <form action="{{ route('logout') }}" method="POST" class="mt-2 px-2">
                @csrf
                <button class="btn btn-sm btn-outline-danger w-100">Logout</button>
            </form>
        @endauth
    </nav>
</aside>