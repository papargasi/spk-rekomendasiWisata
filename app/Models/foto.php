<?php

namespace App\Models;
use App\Models\Wisata;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'tbl_gambar'; // nama tabel di database

    protected $fillable = ['id_owi','nm_foto'];

    // Foreign key ke tabel wisata
    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'id_owi', 'id');
    }
}
