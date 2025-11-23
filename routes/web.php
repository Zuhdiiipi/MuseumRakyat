<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\MuseumController;
use App\Http\Controllers\CuratorController;

// Redirect halaman awal ke daftar koleksi
Route::get('/', [ArtifactController::class, 'index'])->name('home');

Route::get('/tes', function () {
    return view('landing.home');
});

// --- ARTIFACTS (KOLEKSI & AI) ---
Route::get('/artifacts', [ArtifactController::class, 'index'])->name('artifacts.index');
Route::get('/artifacts/create', [ArtifactController::class, 'create'])->name('artifacts.create'); // Form Upload
Route::post('/artifacts', [ArtifactController::class, 'store'])->name('artifacts.store'); // Proses Simpan
Route::get('/artifacts/{id}', [ArtifactController::class, 'show'])->name('artifacts.show'); // Detail
Route::delete('/artifacts/{id}', [ArtifactController::class, 'destroy'])->name('artifacts.destroy');
Route::get('/my-archive', [ArtifactController::class, 'myArtifacts'])->name('artifacts.my_archive');

// API AJAX untuk Cek Status Tripo & Proxy Model 3D
Route::get('/artifacts/check-status/{id}', [ArtifactController::class, 'checkStatus']);
Route::get('/artifacts/proxy', [ArtifactController::class, 'proxyModel']);

// --- MUSEUMS (PETA GIS) ---
Route::get('/museums', [MuseumController::class, 'index'])->name('museums.index'); // Halaman Peta
Route::get('/api/museums-json', [MuseumController::class, 'mapData']); // JSON Data Peta
Route::get('/museums/{id}', [MuseumController::class, 'show'])->name('museums.show'); // Detail Museum
// Route::post('/museums', [MuseumController::class, 'store'])->name('museums.store'); // (Matikan dulu kalau belum perlu)

// --- CURATOR (DASHBOARD) ---
// Harusnya dilindungi middleware admin, tapi kita buka dulu untuk testing
Route::get('/dashboard/curator', [CuratorController::class, 'index'])->name('curator.index');
Route::post('/curator/approve/{id}', [CuratorController::class, 'approve'])->name('curator.approve');
Route::post('/curator/reject/{id}', [CuratorController::class, 'reject'])->name('curator.reject');
