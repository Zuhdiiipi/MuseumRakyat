@extends('layouts.app')

@section('title', 'Tambah Artefak')

@section('content')
<div class="container py-4">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <h1 class="h4 mb-4">Tambah Artefak Budaya</h1>

    <form action="{{ route('user.artifacts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Judul Artefak</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Material / Bahan</label>
            <input type="text" name="material" class="form-control" value="{{ old('material') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Fungsi / Kegunaan</label>
            <input type="text" name="function" class="form-control" value="{{ old('function') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Asal Daerah(Kabupaten)</label>
            <input type="text" name="origin_region" class="form-control" value="{{ old('origin_region') }}" placeholder="Misal: Majene, Polman, Mamasa">
        </div>
        <div class="mb-3">
            <label class="form-label">Provinsi</label>
            <input type="text" name="origin_province" class="form-control" value="{{ old('origin_province') }}" placeholder="Misal: Sulawesi Barat">
        </div>
        <div class="mb-3">
            <label class="form-label">Foto Artefak</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
            <small class="text-muted">Maksimal 5 MB.</small>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('user.artifacts.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Artefak</button>
        </div>
    </form>
</div>
@endsection