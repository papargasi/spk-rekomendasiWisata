<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekomendasiController;

Route::get('/', function () {
    return view('layout');
});
Route::get('/rekomendasi', [RekomendasiController::class, 'index']);
Route::get('/create', [RekomendasiController::class, 'create'])->name('wisata.create');
Route::post('/store', [RekomendasiController::class, 'store'])->name('wisata.store');