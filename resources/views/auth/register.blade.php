<x-guest-layout>
    <div class="register-wrapper">

        <h2 class="register-title">Daftar sebagai Kontributor</h2>
        <p class="register-subtitle">
            Jadilah bagian dari Museum Rakyat dan unggah koleksi budaya yang kamu miliki.
        </p>

        <form method="POST" action="{{ route('register') }}" class="register-form">
            @csrf

            <div class="input-group">
                <label for="name" class="input-label">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                       placeholder="Masukkan nama lengkap" class="input-field" required autofocus>
                <x-input-error :messages="$errors->get('name')" class="input-error" />
            </div>

            <div class="input-group">
                <label for="email" class="input-label">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       placeholder="Alamat email aktif" class="input-field" required>
                <x-input-error :messages="$errors->get('email')" class="input-error" />
            </div>

            <div class="input-group">
                <label for="password" class="input-label">Password</label>
                <input id="password" type="password" name="password"
                       placeholder="Minimal 8 karakter" class="input-field" required>
                <x-input-error :messages="$errors->get('password')" class="input-error" />
            </div>

            <div class="input-group">
                <label for="password_confirmation" class="input-label">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       placeholder="Ulangi password" class="input-field" required>
                <x-input-error :messages="$errors->get('password_confirmation')" class="input-error" />
            </div>

            <button type="submit" class="btn-register">
                Daftar
            </button>

            <p class="login-hint">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="login-link">Masuk di sini</a>
            </p>
        </form>

    </div>
</x-guest-layout>
