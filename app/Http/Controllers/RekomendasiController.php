<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\foto;
use App\Models\BobotKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


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
        'rating' => 'required|numeric',
        'kebersihan' => 'required|numeric',
        'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // Simpan data utama wisata
    $wisata = Wisata::create([
        'nama' => $request->nama,
        'jenis' => $request->jenis,
        'deskripsi' => $request->deskripsi,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'rating' => $request->rating, // default atau boleh dihilangkan kalau tidak dipakai sekarang
        'kebersihan' => $request->kebersihan,
    ]);

    // Simpan setiap foto ke storage dan database
    if ($request->hasFile('foto')) {
        foreach ($request->file('foto') as $file) {
            $path = $file->store('wisata', 'public');

            Foto::create([
                'id_owi' => $wisata->id,
                'nm_foto' => $path
            ]);
        }
    }

    return redirect('dataOwi')->with('success', 'Data wisata dan foto berhasil ditambahkan!');
}
public function updateInfo(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'jenis' => 'required',
        'deskripsi' => 'nullable',
    ]);

    $wisata = Wisata::findOrFail($id);

    $wisata->update([
        'nama' => $request->nama,
        'jenis' => $request->jenis,
        'deskripsi' => $request->deskripsi,
    ]);

    return redirect('dataOwi')->with('success', 'Data wisata dan foto berhasil ditambahkan!');
}
public function updateRating(Request $request, $id)
{
    $request->validate([
        'rating' => 'required',
        'kebersihan' => 'required',
    ]);

    $wisata = Wisata::findOrFail($id);

    $wisata->update([
        'rating' => $request->rating,
        'kebersihan' => $request->kebersihan,
    ]);

    return redirect('dataOwi')->with('success', 'Data wisata dan foto berhasil ditambahkan!');
}
public function updateSingleFoto(Request $request, $id)
{
    $request->validate([
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $foto = Foto::findOrFail($id);

    // Hapus foto lama jika ada
    if ($foto->nm_foto && Storage::disk('public')->exists($foto->nm_foto)) {
        Storage::disk('public')->delete($foto->nm_foto);
    }

    // Simpan foto baru dengan path 'wisata/nama_baru'
    $fotoBaru = $request->file('foto');
    $namaBaru = 'wisata/' . time() . '_' . $fotoBaru->getClientOriginalName();
    $fotoBaru->storeAs('public', $namaBaru); // simpan ke storage/app/public/wisata

    // Update nama file di database
    $foto->nm_foto = $namaBaru; // simpan path 'wisata/nama_baru' di DB
    $foto->save();

    return back()->with('success', 'Foto berhasil diperbarui.');
}


public function deleteFoto($id)
{
    $foto = Foto::findOrFail($id);

    // Hapus file dari storage
    Storage::disk('public')->delete($foto->nm_foto);

    // Hapus dari database
    $foto->delete();

    return back()->with('success', 'Foto berhasil dihapus!');
}

    public function tambahFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $file = $request->file('foto');
        $path = $file->store('wisata', 'public');

        Foto::create([
            'id_owi' => $id, // gunakan parameter $id langsung
            'nm_foto' => $path, // simpan path yang sudah disimpan di storage
        ]);

        return redirect()->back()->with('success', 'Foto berhasil ditambahkan.');
    }

        


}