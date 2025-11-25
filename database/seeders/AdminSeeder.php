<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@museum.id'], // agar tidak dobel kalau seed ulang
            [
                'name' => 'admin',
                'password' => Hash::make('password'),
                'role' => 'ADMIN',
            ]
        );
    }
}
