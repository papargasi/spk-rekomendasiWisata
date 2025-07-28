<?php

namespace App\Http\Controllers;
use App\Models\Wisata;
use Illuminate\Http\Request;

class OwiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Wisata::all();
        return view('dataOwi',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function detailOwi($id)
    {
        $data = Wisata::findOrFail($id);
        return view('detailDataOwi',compact('data'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
