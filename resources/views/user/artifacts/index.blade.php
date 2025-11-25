@extends('layouts.app')

@section('title', 'Arsip Saya')

@section('content')
<div class="container py-4">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Arsip Saya (Demo tanpa Auth)</h1>
        <a href="{{ route('user.artifacts.create') }}" class="btn btn-primary">
            + Tambah Artefak
        </a>
    </div>

    @if ($artifacts->isEmpty())
        <div class="alert alert-info">
            Belum ada artefak. Silakan tambahkan artefak pertama Anda.
        </div>
    @else
        <div class="row">
            @foreach ($artifacts as $artifact)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if ($artifact->image_path)
                            <img
                                src="{{ asset('storage/' . $artifact->image_path) }}"
                                class="card-img-top"
                                style="object-fit: cover; height: 200px;"
                                alt="{{ $artifact->title }}"
                            >
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $artifact->title ?? 'Tanpa Judul' }}
                            </h5>
                            <p class="card-text text-muted">
                                {{ $artifact->origin_region ?: 'Asal daerah tidak diisi' }}
                            </p>
                            <span class="badge 
                                @if($artifact->status === 'APPROVED') bg-success
                                @elseif($artifact->status === 'REJECTED') bg-danger
                                @else bg-warning text-dark @endif">
                                {{ $artifact->status }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div>
            {{ $artifacts->links() }}
        </div>
    @endif
</div>
@endsection
