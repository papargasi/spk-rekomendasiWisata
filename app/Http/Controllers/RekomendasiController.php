<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\BobotKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekomendasiController extends Controller
{
    public function index()
{
    $bobot = BobotKriteria::pluck('bobot', 'kriteria');

    $wisatas = Wisata::with('penilaian')->get();

    foreach ($wisatas as $wisata) {
        $p = $wisata->penilaian;

        if ($p) {
            $skor = ($p->rating * $bobot['rating']) +
                    ($p->jarak * $bobot['jarak']) +
                    ($p->kebersihan * $bobot['kebersihan']);

            $p->nilai_total = $skor;
            $p->save();
        }
    }

    // Sort by nilai_total descending (dari relasi)
    $hasil = $wisatas->sortByDesc(function ($w) {
        return $w->penilaian->nilai_total ?? 0;
    });

    return view('rekomendasi', compact('hasil'));
}

}

