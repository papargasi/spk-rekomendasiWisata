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
        'deskripsi' => 'nullable',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'rating' => 'required|numeric|min:0|max:5',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $data = $request->except('gambar');

    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')->store('wisata', 'public');
    }

    Wisata::create($data);

    return redirect('rekomendasi')->with('success', 'Data wisata berhasil ditambahkan!');
}
}

