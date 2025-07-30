<?php

namespace App\Http\Controllers;
use App\Models\BobotKriteria;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    public function index(){
        $data = BobotKriteria::all();
        return view('kategori',compact('data'));
    }
}
