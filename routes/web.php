<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekomendasiController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/rekomendasi', [RekomendasiController::class, 'index']);
