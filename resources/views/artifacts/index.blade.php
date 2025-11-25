@extends('layouts.app')

@section('title', 'Galeri Koleksi - MuseumRakyat')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-white">Galeri Koleksi</h2>
        <p class="text-white-50">Menampilkan arsip budaya yang telah terverifikasi.</p>
    </div>
    
    <form action="{{ route('artifacts.index') }}" method="GET" class="d-flex gap-2">
        <select name="category" class="form-select form-select-sm bg-dark text-white border-secondary" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            <option value="BENDA" {{ request('category') == 'BENDA' ? 'selected' : '' }}>🏺 Benda</option>
            <option value="TAK_BENDA" {{ request('category') == 'TAK_BENDA' ? 'selected' : '' }}>🎵 Tak Benda</option>
            <option value="SITUS" {{ request('category') == 'SITUS' ? 'selected' : '' }}>architecture Situs</option>
        </select>
        <input type="text" name="search" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="Cari..." value="{{ request('search') }}">
    </form>
</div>

<div class="koleksi-grid">
    @forelse($artifacts as $artifact)
    <a href="{{ route('artifacts.show', $artifact->id) }}" class="text-decoration-none">
        <article class="koleksi-card h-100">
            <div class="koleksi-image-wrapper position-relative">
                @if($artifact->image_path)
                    <img src="{{ asset('storage/' . $artifact->image_path) }}" alt="{{ $artifact->title }}">
                @else
                    <div class="d-flex align-items-center justify-content-center h-100 bg-secondary text-white">
                        <span class="fs-1">🎵</span>
                    </div>
                @endif

                <span class="position-absolute top-0 end-0 badge bg-warning text-dark m-2">
                    {{ $artifact->category }}
                </span>
            </div>
            
            <div class="koleksi-body">
                <h3 class="koleksi-card-title text-white">{{ Str::limit($artifact->title, 30) }}</h3>
                <p class="koleksi-card-meta">
                    {{ $artifact->origin_region ?? 'Sulawesi Barat' }} 
                    &middot; {{ $artifact->created_at->format('d M Y') }}
                </p>
                <p class="koleksi-card-desc">
                    {{ Str::limit($artifact->description, 80) }}
                </p>
            </div>
        </article>
    </a>
    @empty
    <div class="col-12 text-center py-5">
        <h3 class="text-white-50">Belum ada koleksi ditemukan.</h3>
        {{-- <a href="{{ route('artifacts.create') }}" class="btn btn-primary mt-3">Upload Sekarang</a> --}}
    </div>
    @endforelse
</div>

<div class="mt-5 d-flex justify-content-center">
    {{ $artifacts->links() }}
</div>
@endsection