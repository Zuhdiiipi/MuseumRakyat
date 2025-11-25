<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CuratorSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'curator@museum.id'], // agar tidak dobel kalau seed ulang
            [
                'name' => 'Kurator',
                'password' => Hash::make('password'),
                'role' => 'CURATOR',
            ]
        );
    }
}
