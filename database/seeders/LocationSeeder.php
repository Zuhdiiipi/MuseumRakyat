<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{  public function run(): void
    {
        $locations = [
            [
                'name' => 'Museum Mandar Majene',
                'type' => 'MUSEUM',
                'lat' => -3.5400000,
                'lng' => 118.9666667,
                'district' => 'Banggae',
                'province' => 'Sulawesi Barat',
                'meta' => [
                    'description' => 'Museum daerah yang menyimpan koleksi sejarah dan budaya Mandar.',
                ],
            ],
            [
                'name' => 'Rumah Adat Boyang',
                'type' => 'SITE',
                'lat' => -3.5505000,
                'lng' => 118.9700000,
                'district' => 'Banggae',
                'province' => 'Sulawesi Barat',
                'meta' => [
                    'description' => 'Contoh rumah adat Mandar (Boyang).',
                ],
            ],
            [
                'name' => 'Lapangan Sayyang Pattuqduq',
                'type' => 'SITE',
                'lat' => -3.5580000,
                'lng' => 118.9800000,
                'district' => 'Banggae Timur',
                'province' => 'Sulawesi Barat',
                'meta' => [
                    'description' => 'Lokasi pelaksanaan tradisi Sayyang Pattuqduq.',
                ],
            ],
            [
                'name' => 'Sentra Tenun Saqbe',
                'type' => 'SITE',
                'lat' => -3.6000000,
                'lng' => 118.9500000,
                'district' => 'Pamboang',
                'province' => 'Sulawesi Barat',
                'meta' => [
                    'description' => 'Kampung pengrajin tenun Saqbe Mandar.',
                ],
            ],
        ];

        foreach ($locations as $data) {
            Location::updateOrCreate(
                [
                    'name' => $data['name'],
                    'type' => $data['type'],
                ],
                [
                    'lat' => $data['lat'],
                    'lng' => $data['lng'],
                    'district' => $data['district'],
                    'province' => $data['province'],
                    'meta' => $data['meta'],
                ]
            );
        }
    }
}
