<?php

namespace App\Http\Controllers;

use App\Models\Museum;

class MuseumMapController extends Controller
{
    public function sulbar()
    {
        return Museum::select([
            'id',
            'name',
            'type',
            'address',
            'district',
            'photo_url',
            'latitude',
            'longitude'
        ])->get();
    }
}
