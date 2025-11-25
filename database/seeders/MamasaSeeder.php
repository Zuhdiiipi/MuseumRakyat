<?php

namespace Database\Seeders;

use App\Models\Museum;
use Illuminate\Database\Seeder;

class MamasaSeeder extends Seeder
{
    public function run(): void
    {
        // Menambahkan Museum Demmatande tanpa menghapus yang lain
        Museum::create([
            'name' => 'Museum Demmatande',
            'type' => 'MUSEUM',
            'description' => 'Museum yang menyimpan peninggalan sejarah Demmatande, pejuang dan pemimpin adat Mamasa, serta koleksi tenun dan ukiran khas Mamasa.',
            'address' => 'Desa Patobong, Kec. Mamasa',
            'district' => 'Mamasa',
            'province' => 'Sulawesi Barat',

            // Koordinat Pusat Mamasa (Silakan sesuaikan jika punya titik pas)
            'latitude' => -2.916250,
            'longitude' => 119.391580,

            'meta' => ['jam_buka' => '08:00 - 16:00', 'tiket' => 'Rp 5.000'],
            'photo_url' => null // Bisa diisi URL gambar jika ada
        ]);
    }
}
