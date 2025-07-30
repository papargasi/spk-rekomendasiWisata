<?php

namespace App\Http\Controllers;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class penilaianController extends Controller
{
    public function index(){
        $data = Penilaian::all();
        return view('penilaian',compact('data'));
    }
}
