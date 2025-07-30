<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class customerController extends Controller
{
    public function index(){
        return view('halamanCustomer.index');
    }
}
