<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AudioArchive extends Model
{
     use HasFactory;

   protected $table = 'audio_archives';

    protected $fillable = [
        'artifact_id',
        'user_id',
        'object_key_audio',
        'transcript',
        'language',
    ];

    public function artifact()
    {
        return $this->belongsTo(Artifact::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
