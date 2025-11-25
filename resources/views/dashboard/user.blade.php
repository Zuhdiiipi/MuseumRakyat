@extends('layouts.app')

@section('title', 'Arsip Saya - MuseumRakyat')

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <h2 class="fw-bold text-white">📂 Arsip Saya</h2>
        <p class="text-muted">Pantau status kurasi dan proses digitalisasi koleksi yang Anda unggah.</p>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card bg-dark border border-secondary text-white h-100">
            <div class="card-body">
                <h6 class="text-warning text-uppercase small fw-bold">Total Kontribusi</h6>
                <h2 class="display-4 fw-bold mb-0">{{ $myArtifacts->total() }}</h2>
                <p class="text-white-50 small">Item budaya yang telah Anda digitalkan.</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-8 mb-4">
        <div class="card bg-dark border border-secondary text-white h-100 d-flex align-items-center justify-content-center p-4">
            <div class="text-center">
                <h5 class="mb-3">Punya koleksi lain?</h5>
                <a href="{{ route('artifacts.create') }}" class="btn btn-primary rounded-pill px-4">
                    + Upload Koleksi Baru
                </a>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card bg-dark border border-secondary shadow-sm">
            <div class="card-header bg-black border-bottom border-secondary py-3">
                <h5 class="mb-0 text-white">Riwayat Unggahan</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0" style="border-color: rgba(255,255,255,0.1);">
                    <thead>
                        <tr class="text-secondary small text-uppercase">
                            <th class="ps-4">Koleksi</th>
                            <th>Tanggal</th>
                            <th>Status Kurasi</th>
                            <th>Status AI (3D)</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($myArtifacts as $item)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div style="width: 45px; height: 45px;" class="rounded me-3 bg-secondary overflow-hidden">
                                        @if($item->image_path)
                                            <img src="{{ asset('storage/' . $item->image_path) }}" class="w-100 h-100 object-fit-cover">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center h-100 text-white small">🎵</div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="fw-bold text-white">{{ Str::limit($item->title, 25) }}</div>
                                        <div class="small text-muted">{{ $item->category }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-muted small">
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                            <td>
                                @if($item->curation_status == 'APPROVED')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($item->curation_status == 'REJECTED')
                                    <span class="badge bg-danger">Ditolak</span>
                                    <br><small class="text-danger fst-italic">{{ $item->curator_note }}</small>
                                @else
                                    <span class="badge bg-secondary">Menunggu Review</span>
                                @endif
                            </td>
                            <td>
                                @if($item->category == 'BENDA')
                                    @if($item->ai_status == 'SUCCESS')
                                        <span class="text-success small"><i class="bi bi-check-circle"></i> Selesai</span>
                                    @elseif($item->ai_status == 'PROCESSING')
                                        <div class="spinner-border spinner-border-sm text-warning" role="status"></div> 
                                        <span class="text-warning small">Memproses...</span>
                                    @elseif($item->ai_status == 'FAILED')
                                        <span class="text-danger small"><i class="bi bi-x-circle"></i> Gagal</span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                @else
                                    <span class="text-muted small">N/A</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('artifacts.show', $item->id) }}" class="btn btn-sm btn-outline-light">
                                    Lihat
                                </a>
                                {{-- Tombol Hapus hanya jika masih PENDING atau REJECTED --}}
                                @if($item->curation_status !== 'APPROVED')
                                <form action="{{ route('artifacts.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Batalkan unggahan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger border-0">🗑️</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                Belum ada arsip yang Anda unggah.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-black border-top border-secondary">
                {{ $myArtifacts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection