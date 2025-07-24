<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\BobotKriteria;
use Illuminate\Http\Request;

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

        // Ambil data berdasarkan nilai SMART tertinggi
        $hasil = Wisata::with('penilaian')->orderByDesc('penilaian.nilai_total')->get();

        return view('user.rekomendasi', compact('hasil'));
    }
}

