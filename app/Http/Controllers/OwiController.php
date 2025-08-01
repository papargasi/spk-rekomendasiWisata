<?php

namespace App\Http\Controllers;
use App\Models\Wisata;
use App\Models\foto;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class OwiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Wisata::all();
        return view('dataOwi',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function detailOwi($id)
    {
        $data = Wisata::with('foto')->findOrFail($id);
        return view('detailDataOwi', compact('data'));
    }
    public function detailInfoOwi($id)
    {
        $data = Wisata::findOrFail($id);
        return view('updateOwi.edit_info_owi', compact('data'));
    }
    public function detailRatingOwi($id)
    {
        $data = Wisata::findOrFail($id);
        return view('updateOwi.edit_rating_owi', compact('data'));
    }
    public function detailFotoOwi($id)
    {
        $data = Wisata::with('foto')->findOrFail($id);
        return view('updateOwi.edit_foto_owi', compact('data'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
        'nama' => 'required',
        'jenis' => 'required',
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(string $id)
{
    // Ambil semua foto yang berkaitan
    $fotos = Foto::where('id_owi', $id)->get();

    foreach ($fotos as $foto) {
        $path = public_path('storage/' . $foto->nm_foto); // Contoh: public/storage/wisata/foto.jpg

        if (File::exists($path)) {
            unlink($path); // atau File::delete($path);
        }
    }

    // Hapus entri foto dari database
    Foto::where('id_owi', $id)->delete();

    // Hapus entri wisata
    Wisata::destroy($id);

    return redirect()->route('wisata.index')->with('success', 'Data berhasil dihapus');
}
}
