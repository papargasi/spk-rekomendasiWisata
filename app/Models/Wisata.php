<?php

namespace App\Models;
use App\Models\foto;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
protected $fillable = ['id','nama', 'deskripsi', 'latitude', 'longitude', 'rating', 'gambar'];

    public function penilaian()
    {
        return $this->hasOne(Penilaian::class);
    }

    public function foto()
    {
        return $this->hasMany(Foto::class, 'id_owi', 'id');
    }
    public function fotoPertama()
    {
        return $this->hasOne(Foto::class, 'id_owi','id')->oldest();
    }

}
