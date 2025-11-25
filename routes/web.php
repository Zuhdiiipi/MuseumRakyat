<?php

use Illuminate\Support\Facades\Route;

// --- IMPORT CONTROLLER YANG DIPERLUKAN ---
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\MuseumController;
use App\Http\Controllers\CuratorController;
use App\Http\Controllers\ProfileController;

// ================== HALAMAN UTAMA (LANDING / HOME) ==================
Route::get('/', function () {
    return redirect()->route('artifacts.index');
})->name('home');

// ================== ARTIFACTS (PUBLIK) ==================
Route::get('/artifacts', [ArtifactController::class, 'index'])->name('artifacts.index');

// ================== API PUBLIC (UNTUK JS/AJAX) ==================
Route::get('/artifacts/check-status/{id}', [ArtifactController::class, 'checkStatus'])
    ->name('artifacts.check_status');
Route::get('/artifacts/proxy', [ArtifactController::class, 'proxyModel'])
    ->name('artifacts.proxy');

// ================== DETAIL ARTIFAK (PUBLIK, ID HANYA ANGKA) ==================
Route::get('/artifacts/{id}', [ArtifactController::class, 'show'])
    ->whereNumber('id')
    ->name('artifacts.show');

// ================== MUSEUMS (PUBLIK) ==================
Route::get('/museums', [MuseumController::class, 'index'])->name('museums.index');
Route::get('/api/museums-json', [MuseumController::class, 'mapData']);
Route::get('/museums/{id}', [MuseumController::class, 'show'])->name('museums.show');

// ================== ROUTE YANG WAJIB LOGIN (AUTH) ==================
Route::middleware('auth')->group(function () {

    // ---------- PROFIL USER ----------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ---------- KONTRIBUTOR (USER BIASA) ----------
    Route::middleware('role:user')->group(function () {
        Route::get('/artifacts/create', [ArtifactController::class, 'create'])->name('artifacts.create');
        Route::post('/artifacts', [ArtifactController::class, 'store'])->name('artifacts.store');
        Route::delete('/artifacts/{id}', [ArtifactController::class, 'destroy'])->name('artifacts.destroy');

        // Arsip Saya (dashboard kontributor)
        Route::get('/my-archive', [ArtifactController::class, 'myArtifacts'])->name('artifacts.my_archive');
    });

    // ---------- KURATOR ----------
    Route::middleware('role:curator')->group(function () {
        Route::get('/dashboard/curator', [CuratorController::class, 'index'])->name('curator.index');
        Route::post('/curator/approve/{id}', [CuratorController::class, 'approve'])->name('curator.approve');
        Route::post('/curator/reject/{id}', [CuratorController::class, 'reject'])->name('curator.reject');
    });

    // ---------- ADMIN ----------
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:admin')
        ->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('index');
            Route::get('/users', [AdminController::class, 'users'])->name('users');
            Route::post('/users/{id}/toggle', [AdminController::class, 'toggleUserStatus'])->name('users.toggle');

            // Tambah museum via MuseumController (reuse logic)
            Route::post('/museums', [MuseumController::class, 'store'])->name('museums.store');
        });

    // ---------- DASHBOARD BAWAAN ----------
    // Dipakai kalau AuthenticatedSessionController me-redirect ke route('dashboard')
    // Di sini kita arahkan ke daftar koleksi saja.
    Route::get('/dashboard', function () {
        return redirect()->route('artifacts.index');
    })->name('dashboard');
});

require __DIR__ . '/auth.php';
