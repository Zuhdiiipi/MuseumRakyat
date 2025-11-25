<?php

namespace Database\Seeders;

use App\Models\Museum;
use Illuminate\Database\Seeder;

class MuseumSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Museum Mandar (Majene)
        Museum::create([
            'name' => 'Museum Mandar',
            'type' => 'MUSEUM',
            'description' => 'Museum utama yang menyimpan ribuan koleksi naskah kuno, keris, dan pakaian adat raja-raja Mandar.',
            'address' => 'Jl. Raden Suradi, Pangali-Ali, Kec. Banggae',
            'district' => 'Banggae',
            'province' => 'Sulawesi Barat',
            'latitude' => -3.541334,
            'longitude' => 118.972338,
            
            'meta' => ['jam_buka' => '08:00 - 16:00', 'tiket' => 'Gratis'],
            // Jika ada foto, ganti null dengan url
            'photo_url' => null
        ]);

        
    }
}
