<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
        protected $fillable = ['wisata_id', 'rating', 'jarak', 'kebersihan', 'nilai_total'];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class);
    }
}
