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

        // 2. Makam Raja-Raja Hadat Banggae (Situs)
        Museum::create([
            'name' => 'Kompleks Makam Raja Banggae',
            'type' => 'SITUS',
            'description' => 'Situs pemakaman kuno raja-raja Banggae yang terletak di atas bukit dengan pemandangan laut.',
            'address' => 'Ondongan, Kec. Banggae',
            'district' => 'Banggae',
            'province' => 'Sulawesi Barat',
            'latitude' => -3.547510788828193,
            'longitude' => 118.96228774136566,
            'meta' => ['jam_buka' => '24 Jam'],
            'photo_url' => null
        ]);

        // 3. Taman Budaya (Tinambung)
        Museum::create([
            'name' => 'Taman Budaya Tinambung',
            'type' => 'SANGGAR',
            'description' => 'Pusat kegiatan seni dan pelestarian tradisi lisan Kalindaqdaq.',
            'address' => 'Tinambung, Polman',
            'district' => 'Tinambung',
            'province' => 'Sulawesi Barat',
            'latitude' => -3.480000,
            'longitude' => 119.020000,
            'meta' => ['jam_buka' => '09:00 - 20:00'],
            'photo_url' => null
        ]);
    }
}
