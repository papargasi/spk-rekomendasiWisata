<?php

namespace App\Http\Controllers;
use App\Models\Wisata;
use App\Models\foto;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        $data = Wisata::with('foto')->get();
        $totalOwi = $data->count();
        $totalGaleri = foto::all()->count();
        $avgPenilaian = (float) Penilaian::avg('rating');
        $wisataData = Wisata::with('fotoUtama')->get(); // ambil semua wisata dari database

        return view('welcome',compact('data','totalOwi','totalGaleri','avgPenilaian','wisataData'));

    }
}
