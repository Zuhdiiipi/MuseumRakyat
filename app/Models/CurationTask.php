<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurationTask extends Model
{
    use HasFactory;

   protected $table = 'curation_tasks';

    protected $fillable = [
        'artifact_id',
        'curator_id',
        'status',
        'note',
    ];

    public function artifact()
    {
        return $this->belongsTo(Artifact::class);
    }

    public function curator()
    {
        return $this->belongsTo(User::class, 'curator_id');
    }
}
