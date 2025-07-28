<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Wisata;
use App\Models\Penilaian;

class WisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                $wisatas = [
        [
            'nama' => 'Gunung Ciremai',
            'deskripsi' => 'Wisata alam pendakian',
            'latitude' => -6.8915,
            'longitude' => 108.4061,
            'rating' => 4.8
        ],
        [
            'nama' => 'Keraton Kasepuhan',
            'deskripsi' => 'Keraton bersejarah di Cirebon',
            'latitude' => -6.7112,
            'longitude' => 108.5740,
            'rating' => 4.6
        ],
        [
            'nama' => 'Makam Sunan Gunung Jati',
            'deskripsi' => 'Wisata religi ziarah',
            'latitude' => -6.6885,
            'longitude' => 108.5661,
            'rating' => 4.7
        ]
    ];


    foreach ($wisatas as $w) {
        $wisata = Wisata::create($w);

        Penilaian::create([
            'wisata_id' => $wisata->id,
            'rating' => rand(30, 50) / 10,      // 3.0 - 5.0
            'jarak' => rand(10, 100) / 10,      // 1 - 10 km
            'kebersihan' => rand(30, 50) / 10,  // 3.0 - 5.0
            'nilai_total' => 0,
        ]);
    }
    }
}
