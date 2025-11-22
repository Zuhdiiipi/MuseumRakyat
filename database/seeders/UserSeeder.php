<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@museumrakyat.test'],
            [
                'name' => 'Admin MuseumRakyat',
                'phone' => '081111111111',
                'password' => Hash::make('password'),
                'role' => 'ADMIN',
            ]
        );

        // Curator
        User::updateOrCreate(
            ['email' => 'kurator@museumrakyat.test'],
            [
                'name' => 'Kurator Budaya Mandar',
                'phone' => '082222222222',
                'password' => Hash::make('password'),
                'role' => 'CURATOR',
            ]
        );

        // User biasa
        User::updateOrCreate(
            ['email' => 'user1@museumrakyat.test'],
            [
                'name' => 'Kontributor Budaya 1',
                'phone' => '083333333331',
                'password' => Hash::make('password'),
                'role' => 'USER',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user2@museumrakyat.test'],
            [
                'name' => 'Kontributor Budaya 2',
                'phone' => '083333333332',
                'password' => Hash::make('password'),
                'role' => 'USER',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user3@museumrakyat.test'],
            [
                'name' => 'Kontributor Budaya 3',
                'phone' => '083333333333',
                'password' => Hash::make('password'),
                'role' => 'USER',
            ]
        );
    }
}
