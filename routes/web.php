<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\MuseumController;
use App\Http\Controllers\CuratorController;

// ================== HALAMAN UTAMA (LANDING / HOME) ==================
Route::get('/', [ArtifactController::class, 'index'])->name('home');

// ================== ARTIFACTS (PUBLIK) ==================
Route::get('/artifacts', [ArtifactController::class, 'index'])->name('artifacts.index');

// ================== DETAIL ARTIFAK (PUBLIK) ==================
Route::get('/artifacts/{id}', [ArtifactController::class, 'show'])
    ->whereNumber('id')
    ->name('artifacts.show');

// ================== MUSEUMS (PUBLIK) ==================
Route::get('/museums', [MuseumController::class, 'index'])->name('museums.index');
Route::get('/api/museums-json', [MuseumController::class, 'mapData']);
Route::get('/museums/{id}', [MuseumController::class, 'show'])->name('museums.show');

// ================== ROUTE LOGIN WAJIB AUTH ==================
Route::middleware('auth')->group(function () {

    // ---------- KONTRIBUTOR ----------
    Route::middleware('role:user')->group(function () {
        Route::get('/artifacts/create', [ArtifactController::class, 'create'])->name('artifacts.create');
        Route::post('/artifacts', [ArtifactController::class, 'store'])->name('artifacts.store');
        Route::delete('/artifacts/{id}', [ArtifactController::class, 'destroy'])->name('artifacts.destroy');
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
            Route::post('/museums', [MuseumController::class, 'store'])->name('museums.store');
        });

    // ---------- DASHBOARD BAWAAN ----------
    // Bukan admin, bukan kurator → diarahkan ke galeri koleksi
    Route::get('/dashboard', function () {
        return redirect()->route('artifacts.index');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
