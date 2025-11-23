<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    // --- RELASI ---

    // Tag dimiliki oleh banyak barang
    public function artifacts()
    {
        return $this->belongsToMany(Artifact::class, 'artifact_tag');
    }
}