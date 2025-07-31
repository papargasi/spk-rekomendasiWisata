<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\foto;
use App\Models\BobotKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekomendasiController extends Controller
{
    public function index()
{
$wisataData = Wisata::all(); // ambil semua wisata dari database
return view('rekomendasi', compact( 'wisataData'));

}
    public function create() {
        return view('create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'jenis' => 'required',
        'deskripsi' => 'nullable',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // Simpan data utama wisata
    $wisata = Wisata::create([
        'nama' => $request->nama,
        'jenis' => $request->jenis,
        'deskripsi' => $request->deskripsi,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'rating' => 0 // default atau boleh dihilangkan kalau tidak dipakai sekarang
    ]);

    // Simpan setiap foto ke storage dan database
    if ($request->hasFile('foto')) {
        foreach ($request->file('foto') as $file) {
            $path = $file->store('wisata_foto', 'public');

            Foto::create([
                'id_owi' => $wisata->id,
                'nm_foto' => $path
            ]);
        }
    }

    return redirect('rekomendasi')->with('success', 'Data wisata dan foto berhasil ditambahkan!');
}
}