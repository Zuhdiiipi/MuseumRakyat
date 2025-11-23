<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Museum extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type', // 'MUSEUM', 'SITUS', 'SANGGAR', 'LAINNYA'
        'description',
        'address',
        'district',
        'province',
        'photo_url',
        'latitude',
        'longitude',
        'meta', // Data tambahan (Jam buka, tiket, dll)
    ];

    // Otomatis ubah JSON di database menjadi Array di PHP
    protected $casts = [
        'meta' => 'array',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    // --- RELASI ---

    // Museum memiliki banyak koleksi barang
    public function artifacts()
    {
        return $this->hasMany(Artifact::class);
    }
}