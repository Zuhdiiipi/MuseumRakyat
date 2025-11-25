@extends('layouts.app')

@section('title', $artifact->title . ' - Detail')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-lg overflow-hidden h-100">
            
            <div class="bg-black d-flex align-items-center justify-content-center position-relative" style="min-height: 500px;">
                
                {{-- KASUS 1: BENDA FISIK --}}
                @if($artifact->category === 'BENDA')
                    
                    {{-- A. Jika AI Sukses -> Tampilkan 3D --}}
                    @if($artifact->ai_status === 'SUCCESS' && $artifact->model_path)
                        <model-viewer 
                            src="{{ route('artifacts.proxy') }}?url={{ urlencode($artifact->model_path) }}"
                            poster="{{ asset('storage/' . $artifact->image_path) }}"
                            alt="Model 3D {{ $artifact->title }}"
                            auto-rotate
                            camera-controls
                            ar
                            shadow-intensity="1"
                            style="width: 100%; height: 500px; background-color: #1a1a1a;">
                        </model-viewer>
                        <div class="position-absolute bottom-0 start-0 m-3 text-white small">
                            <span class="badge bg-success">3D Ready</span> Geser untuk memutar
                        </div>

                    {{-- B. Jika Masih Proses -> Tampilkan Loading + Script Polling --}}
                    @elseif($artifact->ai_status === 'PROCESSING' || $artifact->ai_status === 'PENDING')
                        <div class="text-center text-white" id="processingState">
                            <div class="spinner-border text-warning mb-3" role="status" style="width: 3rem; height: 3rem;"></div>
                            <h5 class="fw-bold">Sedang Merekonstruksi 3D...</h5>
                            <p class="text-muted small">Mohon tunggu, AI sedang bekerja.<br>Halaman akan update otomatis.</p>
                            <div class="progress mt-3 mx-auto" style="width: 200px; height: 6px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="width: 100%"></div>
                            </div>
                        </div>
                        
                        {{-- Sembunyikan model-viewer dulu --}}
                        <div id="successState" class="d-none w-100 h-100">
                            </div>

                    {{-- C. Jika Gagal atau Foto Biasa --}}
                    @else
                        <img src="{{ asset('storage/' . $artifact->image_path) }}" class="img-fluid" style="max-height: 500px;">
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-danger">3D Gagal / Tidak Tersedia</span>
                        </div>
                    @endif

                {{-- KASUS 2: TAK BENDA (AUDIO) --}}
                @elseif($artifact->category === 'TAK_BENDA')
                    <div class="text-center p-5">
                        <div class="display-1 text-warning mb-4">🎵</div>
                        <h3 class="text-white mb-3">Arsip Rekaman Suara</h3>
                        <audio controls class="w-100" style="min-width: 300px;">
                            <source src="{{ asset('storage/' . $artifact->audio_path) }}">
                            Browser Anda tidak mendukung elemen audio.
                        </audio>
                    </div>

                {{-- KASUS 3: SITUS (FOTO SAJA) --}}
                @else
                    <img src="{{ asset('storage/' . $artifact->image_path) }}" class="img-fluid w-100 object-fit-cover" style="height: 500px;">
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card h-100 border-0" style="background: transparent;">
            <div class="card-body ps-lg-4">
                <span class="badge bg-warning text-dark mb-2">{{ $artifact->category }}</span>
                
                <h1 class="fw-bold text-white mb-3">{{ $artifact->title }}</h1>
                
                <div class="d-flex align-items-center mb-4 text-muted">
                    <div class="me-3">
                        <i class="bi bi-geo-alt text-warning"></i> 
                        {{ $artifact->origin_region ?? 'Sulawesi Barat' }}
                    </div>
                    @if($artifact->museum)
                    <div>
                        <i class="bi bi-bank text-warning"></i> 
                        <a href="{{ route('museums.show', $artifact->museum_id) }}" class="text-decoration-none text-warning">
                            {{ $artifact->museum->name }}
                        </a>
                    </div>
                    @endif
                </div>

                <div class="mb-4">
                    <h5 class="text-warning fw-bold">Deskripsi</h5>
                    <p class="text-white-50" style="line-height: 1.8;">
                        {{ $artifact->description ?? 'Tidak ada deskripsi.' }}
                    </p>
                </div>

                @if($artifact->transcript)
                <div class="mb-4 p-3 bg-dark rounded border border-secondary">
                    <h6 class="text-warning fw-bold">📜 Transkrip / Lirik</h6>
                    <p class="text-white small mb-0 fst-italic">"{{ $artifact->transcript }}"</p>
                </div>
                @endif

                <div class="row g-2 mb-4 text-white-50 small">
                    <div class="col-6"><strong>Material:</strong> <br> {{ $artifact->material ?? '-' }}</div>
                    <div class="col-6"><strong>Fungsi:</strong> <br> {{ $artifact->function ?? '-' }}</div>
                    <div class="col-12 mt-2">
                        <strong>Tags:</strong> <br>
                        @foreach($artifact->tags as $tag)
                            <span class="badge bg-secondary border border-light text-white me-1">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>

                <hr class="border-secondary">
                
                <div class="d-flex align-items-center">
                    <div class="me-auto text-muted small">
                        Diunggah oleh <strong class="text-white">{{ $artifact->user->name ?? 'Anonim' }}</strong><br>
                        {{ $artifact->created_at->diffForHumans() }}
                    </div>
                    @if(Auth::id() === $artifact->user_id || (Auth::user() && Auth::user()->isAdmin()))
                    <form action="{{ route('artifacts.destroy', $artifact->id) }}" method="POST" onsubmit="return confirm('Hapus koleksi ini?');">
                        @csrf @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm">Hapus</button>
                    </form>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // SCRIPT POLLING UNTUK CEK STATUS AI (Hanya jalan jika status PROCESSING)
    @if($artifact->category === 'BENDA' && $artifact->ai_status === 'PROCESSING')
    
    const artifactId = {{ $artifact->id }};
    const checkUrl = `/artifacts/check-status/${artifactId}`;
    
    const poller = setInterval(() => {
        fetch(checkUrl)
            .then(res => res.json())
            .then(response => {
                const data = response.data;
                console.log("AI Status:", data.status);

                if (data.status === 'SUCCESS') {
                    clearInterval(poller); // Stop polling
                    
                    // Ganti tampilan loading jadi model viewer
                    document.getElementById('processingState').classList.add('d-none');
                    
                    const viewer = document.getElementById('successState');
                    viewer.classList.remove('d-none');
                    
                    // Inject Model Viewer HTML
                    // Kita pakai Proxy URL agar tidak kena CORS
                    const proxyUrl = "{{ route('artifacts.proxy') }}?url=" + encodeURIComponent(data.model_url);
                    
                    viewer.innerHTML = `
                        <model-viewer 
                            src="${proxyUrl}"
                            alt="Model 3D Selesai"
                            auto-rotate camera-controls ar shadow-intensity="1"
                            style="width: 100%; height: 500px; background-color: #1a1a1a;">
                        </model-viewer>
                        <div class="position-absolute bottom-0 start-0 m-3 text-white small">
                            <span class="badge bg-success">Selesai!</span> Refresh halaman untuk simpan permanen.
                        </div>
                    `;
                    
                    // Opsional: Reload halaman agar data DB terupdate sempurna
                    setTimeout(() => location.reload(), 2000);
                } 
                else if (data.status === 'FAILED') {
                    clearInterval(poller);
                    alert('Maaf, proses 3D gagal. Silakan coba foto lain.');
                    location.reload();
                }
            })
            .catch(err => console.error(err));
    }, 3000); // Cek setiap 3 detik

    @endif
</script>
@endpush