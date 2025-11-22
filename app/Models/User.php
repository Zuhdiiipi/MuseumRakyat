<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
     use HasFactory, Notifiable;

       protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function artifacts()
    {
        return $this->hasMany(Artifact::class);
    }

    public function curationTasks()
    {
        return $this->hasMany(CurationTask::class, 'curator_id');
    }

    public function audioArchives()
    {
        return $this->hasMany(AudioArchive::class);
    }
}
