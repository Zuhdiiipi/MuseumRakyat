<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Tenun Saqbe',
            'Kalindaqdaq',
            'Sayyang Pattuqduq',
            'Kuliner Mandar',
            'Pusaka Logam',
            'Peralatan Rumah Tangga Tradisional',
            'Upacara Adat',
            'Arsitektur Adat',
            'Permainan Tradisional',
            'Lagu dan Musik Tradisional',
            'Sastra Lisan',
            'Ritual Keagamaan Lokal',
            'Kerajinan Tangan',
            'Sejarah Mandar',
            'Tokoh Adat',
        ];

        foreach ($tags as $name) {
            Tag::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'slug' => Str::slug($name),
                ]
            );
        }
    }

}
