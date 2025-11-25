@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h2 class="fw-bold text-white">🛠️ Admin Control Panel</h2>
        <span class="badge bg-primary fs-6">Super Admin</span>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card bg-dark border border-secondary h-100">
            <div class="card-body">
                <h6 class="text-white-50 text-uppercase small fw-bold">Total Pengguna</h6>
                <h2 class="display-5 fw-bold text-white mb-0">{{ $stats['total_users'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-dark border border-secondary h-100">
            <div class="card-body">
                <h6 class="text-white-50 text-uppercase small fw-bold">Total Koleksi</h6>
                <h2 class="display-5 fw-bold text-warning mb-0">{{ $stats['total_artifacts'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-dark border border-secondary h-100">
            <div class="card-body">
                <h6 class="text-white-50 text-uppercase small fw-bold">Total Museum</h6>
                <h2 class="display-5 fw-bold text-info mb-0">{{ $stats['total_museums'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-dark border border-secondary h-100">
            <div class="card-body">
                <h6 class="text-white-50 text-uppercase small fw-bold">Antrean Kurasi</h6>
                <h2 class="display-5 fw-bold text-danger mb-0">{{ $stats['pending_artifacts'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-5 mb-4">
        <div class="card bg-dark border border-secondary shadow-sm h-100">
            <div class="card-header bg-transparent border-secondary">
                <h5 class="text-white mb-0">🏛️ Tambah Museum Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.museums.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="text-white-50 small">Nama Museum / Situs</label>
                        <input type="text" name="name" class="form-control bg-black text-white border-secondary" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="text-white-50 small">Latitude</label>
                            <input type="text" name="latitude" class="form-control bg-black text-white border-secondary" placeholder="-3.xxxxx" required>
                        </div>
                        <div class="col-6">
                            <label class="text-white-50 small">Longitude</label>
                            <input type="text" name="longitude" class="form-control bg-black text-white border-secondary" placeholder="118.xxxxx" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="text-white-50 small">Kategori</label>
                        <select name="type" class="form-select bg-black text-white border-secondary">
                            <option value="MUSEUM">Gedung Museum</option>
                            <option value="SITUS">Situs Sejarah</option>
                            <option value="SANGGAR">Sanggar Seni</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Lokasi</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-7 mb-4">
        <div class="card bg-dark border border-secondary shadow-sm h-100">
            <div class="card-header bg-transparent border-secondary d-flex justify-content-between align-items-center">
                <h5 class="text-white mb-0">👥 User Terbaru</h5>
                <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-light">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead>
                        <tr class="text-secondary small">
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Join</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestUsers as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-secondary me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-white fw-bold">{{ $user->name }}</div>
                                        <div class="small text-white-50">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($user->role == 'ADMIN') <span class="badge bg-primary">Admin</span>
                                @elseif($user->role == 'CURATOR') <span class="badge bg-info text-dark">Kurator</span>
                                @else <span class="badge bg-secondary">User</span>
                                @endif
                            </td>
                            <td>
                                @if($user->is_active)
                                    <span class="text-success small">● Aktif</span>
                                @else
                                    <span class="text-danger small">● Banned</span>
                                @endif
                            </td>
                            <td class="text-white-50 small">{{ $user->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection