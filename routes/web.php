<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekomendasiController;

Route::get('/', function () {
    return view('layout');
});
Route::get('/rekomendasi', [RekomendasiController::class, 'index']);
