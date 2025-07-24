<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
        protected $fillable = ['nama', 'jenis', 'lokasi', 'deskripsi', 'gambar'];

    public function penilaian()
    {
        return $this->hasOne(Penilaian::class);
    }
}
