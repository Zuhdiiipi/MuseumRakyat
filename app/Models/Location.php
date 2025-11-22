<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
     use HasFactory;

     protected $table = 'locations';

    protected $fillable = [
        'name',
        'type',
        'lat',
        'lng',
        'district',
        'province',
        'meta',
    ];

    protected $casts = [
        'lat'  => 'float',
        'lng'  => 'float',
        'meta' => 'array',
    ];
}
