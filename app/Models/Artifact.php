<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artifact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'museum_id',
        'title',
        'description',
        'category', // 'BENDA', 'TAK_BENDA', 'SITUS'
        'material',
        'function',
        'origin_region',
        'image_path',
        'audio_path',
        'video_path',
        'transcript',
        'language',
        'tripo_task_id',
        'model_path',
        'ai_status', // 'PENDING', 'PROCESSING', 'SUCCESS', 'FAILED'
        'curation_status', // 'PENDING', 'APPROVED', 'REJECTED'
        'curator_note',
        'curator_id',
    ];

    // --- RELASI ---

    // Pemilik/Pengunggah
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Lokasi Museum (Bisa null jika koleksi pribadi)
    public function museum()
    {
        return $this->belongsTo(Museum::class, 'museum_id');
    }

    // Kurator yang memverifikasi
    public function curator()
    {
        return $this->belongsTo(User::class, 'curator_id');
    }

    // Tags (Many-to-Many)
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'artifact_tag');
    }

    // --- SCOPES (Shortcut Query) ---

    // Cara pakai: Artifact::verified()->get();
    public function scopeVerified($query)
    {
        return $query->where('curation_status', 'APPROVED');
    }

    // Cara pakai: Artifact::pending()->get();
    public function scopePending($query)
    {
        return $query->where('curation_status', 'PENDING');
    }

    // Cara pakai: Artifact::benda()->get(); (Ambil yg fisik saja)
    public function scopeBenda($query)
    {
        return $query->where('category', 'BENDA');
    }
}