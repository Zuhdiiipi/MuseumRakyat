<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiSuggestion extends Model
{
    use HasFactory;

    protected $table = 'ai_suggestions';

    protected $fillable = [
        'artifact_id',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function artifact()
    {
        return $this->belongsTo(Artifact::class);
    }
}
