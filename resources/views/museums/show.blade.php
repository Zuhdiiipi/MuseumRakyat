@extends('layouts.app')

@section('title', $museum->name)

@section('content')
<div class="card bg-dark text-white border-0 shadow-lg mb-5 overflow-hidden">
    <div class="row g-0">
        <div class="col-md-5 position-relative">
            @if($museum->photo_url)
                <img src="{{ $museum->photo_url }}" class="img-fluid h-100 object-fit-cover w-100" style="min-height: 300px;">
            @else
                <div class="bg-secondary h-100 d-flex align-items-center justify-content-center" style="min-height: 300px;">
                    <span class="display-1">🏛️</span>
                </div>
            @endif
        </div>
        <div class="col-md-7">
            <div class="card-body p-4 p-lg-5 d-flex flex-column h-100 justify-content-center">
                <span class="badge bg-warning text-dark align-self-start mb-2">{{ $museum->type }}</span>
                <h1 class="display-5 fw-bold mb-3">{{ $museum->name }}</h1>
                <p class="lead text-white-50 mb-4">{{ $museum->description ?? 'Tidak ada deskripsi.' }}</p>
                
                <div class="d-flex gap-4 text-white-50 mb-4">
                    <div><i class="bi bi-geo-alt text-warning"></i> {{ $museum->district }}, {{ $museum->province }}</div>
                    @if(isset($museum->meta['jam_buka']))
                        <div><i class="bi bi-clock text-warning"></i> {{ $museum->meta['jam_buka'] }}</div>
                    @endif
                </div>

                <a href="https://www.google.com/maps/dir/?api=1&destination={{ $museum->latitude }},{{ $museum->longitude }}" 
                   target="_blank" class="btn btn-outline-light w-auto align-self-start">
                    🗺️ Navigasi ke Lokasi
                </a>
            </div>
        </div>
    </div>
</div>

<h3 class="fw-bold text-white mb-4 ps-2 border-start border-4 border-warning">
    Koleksi di Museum Ini ({{ $museum->artifacts->count() }})
</h3>

<div class="koleksi-grid">
    @forelse($museum->artifacts as $artifact)
    <a href="{{ route('artifacts.show', $artifact->id) }}" class="text-decoration-none">
        <article class="koleksi-card h-100">
            <div class="koleksi-image-wrapper position-relative">
                @if($artifact->image_path)
                    <img src="{{ asset('storage/' . $artifact->image_path) }}" alt="{{ $artifact->title }}">
                @else
                    <div class="d-flex align-items-center justify-content-center h-100 bg-secondary text-white">🎵</div>
                @endif
                <span class="position-absolute top-0 end-0 badge bg-warning text-dark m-2">{{ $artifact->category }}</span>
            </div>
            <div class="koleksi-body">
                <h3 class="koleksi-card-title text-white">{{ Str::limit($artifact->title, 30) }}</h3>
                <p class="koleksi-card-meta">{{ $artifact->created_at->format('Y') }}</p>
            </div>
        </article>
    </a>
    @empty
    <div class="col-12 text-center py-5">
        <p class="text-muted">Belum ada koleksi digital di museum ini.</p>
    </div>
    @endforelse
</div>
@endsection