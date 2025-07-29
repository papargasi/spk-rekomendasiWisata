<?php

namespace App\Http\Controllers;
use App\Models\Wisata;
use App\Models\foto;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        $data = Wisata::with('foto')->get();
        return view('welcome', compact('data'));
    }
}
