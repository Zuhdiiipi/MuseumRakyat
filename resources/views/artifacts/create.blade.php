@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark py-3">
                <h5 class="mb-0 fw-bold">Tambahkan Koleksi Baru</h5>
            </div>
            <div class="card-body p-4">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('artifacts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Pilih Museum</label>
                        <select name="museum_id" class="form-select">
                            <option value="">Tidak Masuk Museum</option>
                            @foreach($museums as $museum)
                                <option value="{{ $museum->id }}">{{ $museum->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">Pilih museum jika barang ini fisik tersimpan di sana.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Benda / Judul <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="Contoh: Keris Gayang atau Kalindaqdaq" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi & Sejarah</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Ceritakan sejarah dan kegunaannya..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Kategori Budaya <span class="text-danger">*</span></label>
                        <select name="category" id="categorySelect" class="form-select border-primary" required>
                            <option value="BENDA">BENDA (Fisik - Bisa jadi 3D)</option>
                            <option value="TAK_BENDA">🎵 TAK BENDA (Suara/Tradisi Lisan)</option>
                            <option value="SITUS">architecture SITUS (Bangunan/Tempat)</option>
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6" id="imageInputArea">
                            <label class="form-label">Upload Foto <span class="text-danger" id="imgReq">*</span></label>
                            <input type="file" name="image" class="form-control" accept="image/jpeg,image/png">
                            <div class="form-text">Format JPG/PNG.</div>
                        </div>

                        <div class="col-md-6 d-none" id="audioInputArea">
                            <label class="form-label">Upload Rekaman Suara <span class="text-danger">*</span></label>
                            <input type="file" name="audio" class="form-control" accept="audio/*">
                            <div class="form-text">Format MP3/WAV. Untuk arsip tradisi lisan.</div>
                        </div>
                    </div>

                    <div class="accordion mb-4" id="accordionDetail">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    Detail Tambahan (Material, Asal, Tags)
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionDetail">
                                <div class="accordion-body">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <input type="text" name="material" class="form-control form-control-sm" placeholder="Bahan (Misal: Besi, Kayu)">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="function" class="form-control form-control-sm" placeholder="Fungsi (Misal: Upacara)">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="origin_region" class="form-control form-control-sm" placeholder="Asal (Misal: Pamboang)">
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label class="form-label small">Tags / Label</label>
                                            <select name="tags[]" class="form-select form-select-sm" multiple>
                                                @foreach($tags as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="form-text x-small">Tahan CTRL untuk pilih banyak.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Upload</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Script Sederhana untuk Ganti Tampilan Input berdasarkan Kategori
    const categorySelect = document.getElementById('categorySelect');
    const imageInputArea = document.getElementById('imageInputArea');
    const audioInputArea = document.getElementById('audioInputArea');
    const imgReq = document.getElementById('imgReq');

    categorySelect.addEventListener('change', function() {
        if (this.value === 'TAK_BENDA') {
            // Jika Tak Benda: Audio Muncul, Foto jadi Opsional
            audioInputArea.classList.remove('d-none');
            imgReq.classList.add('d-none'); // Bintang merah hilang
        } else {
            // Jika Benda/Situs: Audio Sembunyi, Foto Wajib
            audioInputArea.classList.add('d-none');
            imgReq.classList.remove('d-none'); // Bintang merah muncul
        }
    });
</script>
@endpush