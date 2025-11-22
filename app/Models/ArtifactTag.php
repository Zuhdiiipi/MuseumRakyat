<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArtifactTag extends Model
{
    use HasFactory;

   protected $table = 'artifact_tag';

    public $timestamps = false;

    protected $fillable = [
        'artifact_id',
        'tag_id',
    ];

    public function artifact()
    {
        return $this->belongsTo(Artifact::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
