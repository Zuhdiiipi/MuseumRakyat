@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card bg-dark border-secondary text-white shadow-lg">
            <div class="card-header border-secondary">
                <h5 class="mb-0">✏️ Edit Profil</h5>
            </div>
            <div class="card-body p-4">
                
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle border border-warning p-1" style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center border border-warning p-1" style="width: 120px; height: 120px;">
                                    <span class="fs-1">👤</span>
                                </div>
                            @endif
                        </div>
                        <div class="mt-2 text-white-50 small">{{ $user->email }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-warning">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control bg-black text-white border-secondary" value="{{ old('name', $user->name) }}" required>
                        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-warning">Email</label>
                        <input type="email" name="email" class="form-control bg-black text-white border-secondary" value="{{ old('email', $user->email) }}" required>
                        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-warning">Ganti Foto Profil</label>
                        <input type="file" name="avatar" class="form-control bg-black text-white border-secondary" accept="image/*">
                        <div class="form-text text-white-50">Format: JPG/PNG, Maks 2MB.</div>
                        @error('avatar') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>

                <hr class="border-secondary my-4">

                <div class="text-center">
                    <h6 class="text-danger fw-bold">Zona Bahaya</h6>
                    <p class="text-white-50 small">Ingin menghapus akun secara permanen?</p>
                    <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Yakin ingin menghapus akun? Semua data Anda akan hilang.');">
                        @csrf
                        @method('delete')
                        <div class="input-group mb-3 justify-content-center">
                            <input type="password" name="password" class="form-control bg-black text-white border-secondary" placeholder="Masukkan Password Konfirmasi" style="max-width: 250px;">
                            <button class="btn btn-outline-danger" type="submit">Hapus Akun</button>
                        </div>
                        @error('password', 'userDeletion') <div class="text-danger small">{{ $message }}</div> @enderror
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection