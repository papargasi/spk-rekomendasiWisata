<?php

namespace App\Http\Controllers;
use App\Models\Wisata;
use App\Models\foto;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class customerController extends Controller
{
    public function index(){
        $data = Wisata::with('fotoPertama')->get();
        $topBar = Wisata::all();
        return view('halamanCustomer.index',compact('data','topBar'));
    }
    public function detail($id){
        $data = Wisata::with('foto')->findOrFail($id);
        $topBar = Wisata::all();
        return view('halamanCustomer.detailSingle',compact('data','topBar'));
    }
}
