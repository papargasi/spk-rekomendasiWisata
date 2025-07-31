<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
 

class petaController extends Controller
{
    public function index(){
                $wisataData = Wisata::all(); // ambil semua wisata dari database
        return view('mapConfig', compact('wisataData'));
    }
}
