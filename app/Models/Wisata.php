<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
protected $fillable = ['nama', 'deskripsi', 'latitude', 'longitude', 'rating', 'gambar'];

    public function penilaian()
    {
        return $this->hasOne(Penilaian::class);
    }
}
