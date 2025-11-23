@extends('layouts.app')

@section('title', 'Dashboard Kurator')

@section('content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm text-white" style="background: linear-gradient(135deg, #7b3a10, #5e2a0a);">
            <div class="card-body p-4">
                <h5 class="card-title text-white-50 mb-0">Menunggu Review</h5>
                <h2 class="display-4 fw-bold my-2">{{ $pendingArtifacts->total() }}</h2>
                <p class="small mb-0 text-white-50">Koleksi baru yang butuh verifikasi.</p>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0">Antrean Kurasi</h5>
                <span class="badge bg-warning text-dark">Role: Curator</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="border-color: rgba(255,255,255,0.1);">
                        <thead class="table-dark text-secondary small text-uppercase">
                            <tr>
                                <th class="ps-4">Koleksi</th>
                                <th>Pengunggah</th>
                                <th>Tanggal</th>
                                <th>Status AI</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingArtifacts as $item)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div style="width: 50px; height: 50px; overflow: hidden;" class="rounded me-3 bg-secondary">
                                            @if($item->image_path)
                                                <img src="{{ asset('storage/' . $item->image_path) }}" class="w-100 h-100 object-fit-cover">
                                            @else
                                                <div class="d-flex align-items-center justify-content-center h-100 text-white small">🎵</div>
                                            @endif
                                        </div>
                                        <div>
                                            <a href="{{ route('artifacts.show', $item->id) }}" class="fw-bold text-decoration-none text-warning">
                                                {{ Str::limit($item->title, 20) }}
                                            </a>
                                            <div class="small text-muted">{{ $item->category }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-muted small">
                                    {{ $item->user->name ?? 'User #' . $item->user_id }}
                                </td>
                                <td class="text-muted small">
                                    {{ $item->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    @if($item->ai_status == 'SUCCESS')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">3D Ready</span>
                                    @elseif($item->ai_status == 'PROCESSING')
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Proses AI</span>
                                    @elseif($item->ai_status == 'FAILED')
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">AI Gagal</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        
                                        <a href="{{ route('artifacts.show', $item->id) }}" class="btn btn-sm btn-outline-light" title="Lihat Detail">
                                            👁️
                                        </a>

                                        <form action="{{ route('curator.approve', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Setujui">
                                                ✅ Approve
                                            </button>
                                        </form>

                                        {{-- Untuk versi cepat, kita reject tanpa alasan dulu atau pakai prompt JS --}}
                                        <form action="{{ route('curator.reject', $item->id) }}" method="POST" onsubmit="let reason = prompt('Alasan penolakan:'); if(reason) { this.action += '?note=' + encodeURIComponent(reason); return true; } else { return false; }">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Tolak">
                                                ❌
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-white-50">
                                    Tidak ada antrean. Semua koleksi sudah diverifikasi.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top border-secondary py-3">
                {{ $pendingArtifacts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection