<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi (Mass Assignment)
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'avatar',
        'institution',
        'bio',
        'is_active',
        'role', // 'USER', 'CURATOR', 'ADMIN'
    ];

    /**
     * Kolom yang disembunyikan saat return JSON (Keamanan)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tipe data otomatis
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    // --- RELASI ---

    // Koleksi yang diupload oleh user ini
    public function artifacts()
    {
        return $this->hasMany(Artifact::class, 'user_id');
    }

    // Koleksi yang dikurasi/verifikasi oleh user ini (sebagai Kurator)
    public function curatedArtifacts()
    {
        return $this->hasMany(Artifact::class, 'curator_id');
    }

    // --- HELPER METHODS (Biar gampang cek role di Controller/Blade) ---

    public function isAdmin()
    {
        return $this->role === 'ADMIN';
    }

    public function isCurator()
    {
        return $this->role === 'CURATOR';
    }
}