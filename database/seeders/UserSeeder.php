<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User Biasa (ID: 1)
        User::create([
            'name' => 'Armawan (User)',
            'email' => 'user@museum.id',
            'password' => Hash::make('password'),
            'role' => 'USER',
        ]);

        // Admin/Kurator (ID: 2)
        User::create([
            'name' => 'Admin',
            'email' => 'admin@museum.id',
            'password' => Hash::make('password'),
            'role' => 'ADMIN                                                                                                                                                                                        ',
        ]);

        User::create([
            'name' => 'Kurator',
            'email' => 'curator@museum.id',
            'password' => Hash::make('password'),
            'role' => 'CURATOR                                                                                                                                                                                    ',
        ]);
    }
}
