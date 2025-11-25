<x-guest-layout>
    <div class="register-wrapper">
        <h2 class="register-title">Masuk ke Museum Rakyat</h2>
        <p class="register-subtitle">
            Akses akun kontributor dan kelola koleksi budaya yang sudah kamu unggah.
        </p>

        <!-- Status / pesan sukses -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="register-form">
            @csrf

            {{-- Email --}}
            <div class="input-group">
                <label for="email" class="input-label">Email</label>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       autocomplete="username"
                       placeholder="Alamat email yang terdaftar"
                       class="input-field">
                <x-input-error :messages="$errors->get('email')" class="input-error" />
            </div>

            {{-- Password --}}
            <div class="input-group">
                <label for="password" class="input-label">Password</label>
                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="current-password"
                       placeholder="Masukkan password"
                       class="input-field">
                <x-input-error :messages="$errors->get('password')" class="input-error" />
            </div>

            {{-- Remember Me + Lupa password --}}
            <div class="input-group input-group-inline">
                <label class="remember-me-label">
                    <input id="remember_me"
                           type="checkbox"
                           name="remember"
                           class="remember-me-checkbox">
                    <span>Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password-link">
                        Lupa password?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn-register">
                Masuk
            </button>

            <p class="login-hint">
                Belum punya akun?
                <a href="{{ route('register') }}" class="login-link">
                    Daftar sebagai kontributor
                </a>
            </p>
        </form>
    </div>
</x-guest-layout>
