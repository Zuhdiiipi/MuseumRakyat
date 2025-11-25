@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-white">Manajemen Pengguna</h2>
    <a href="{{ route('admin.index') }}" class="btn btn-outline-light">Kembali ke Dashboard</a>
</div>

<div class="card bg-dark border-secondary">
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Kontribusi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <span class="fw-bold text-white">{{ $user->name }}</span><br>
                        <span class="small text-muted">{{ $user->email }}</span>
                    </td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->artifacts->count() }} Uploads</td>
                    <td>
                        @if($user->role !== 'ADMIN')
                        <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST">
                            @csrf
                            @if($user->is_active)
                                <button class="btn btn-sm btn-danger">Blokir</button>
                            @else
                                <button class="btn btn-sm btn-success">Aktifkan</button>
                            @endif
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
   <div class="card-footer bg-dark border-secondary d-flex justify-content-center">
    {{ $users->links('pagination::bootstrap-5') }}
</div>

</div>
@endsection