<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BobotKriteria;

class BobotKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $kriteria = [
        ['kriteria' => 'rating', 'bobot' => 0.4],
        ['kriteria' => 'jarak', 'bobot' => 0.3],
        ['kriteria' => 'kebersihan', 'bobot' => 0.3],
    ];

    foreach ($kriteria as $item) {
        BobotKriteria::create($item);
    }
    }
}
