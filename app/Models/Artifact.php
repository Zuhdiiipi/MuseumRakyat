<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Artifact extends Model
{
     protected $table = 'artifacts';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'material',
        'function',
        'origin_region',
        'image_path',      // foto 2D (input Tripo)
        'model_3d_path',   // hasil 3D Tripo
        'status',
        'curator_note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aiSuggestions()
    {
        return $this->hasMany(AiSuggestion::class);
    }

    public function curationTasks()
    {
        return $this->hasMany(CurationTask::class);
    }

    public function audioArchives()
    {
        return $this->hasMany(AudioArchive::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'artifact_tag',
            'artifact_id',
            'tag_id'
        );
    }
}
