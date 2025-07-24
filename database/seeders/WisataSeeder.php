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
        ['nama' => 'Gunung Ciremai', 'jenis' => 'alam', 'lokasi' => 'https://maps.google.com', 'deskripsi' => 'Wisata alam pendakian'],
        ['nama' => 'Keraton Kasepuhan', 'jenis' => 'sejarah', 'lokasi' => 'https://maps.google.com', 'deskripsi' => 'Keraton bersejarah di Cirebon'],
        ['nama' => 'Makam Sunan Gunung Jati', 'jenis' => 'religi', 'lokasi' => 'https://maps.google.com', 'deskripsi' => 'Wisata religi ziarah']
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
