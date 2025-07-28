<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\OwiController;

Route::get('/', function () {
    return view('layout');
});
Route::get('/detail', function () {
    return view('detailDataOwi');
});
Route::get('/rekomendasi', [RekomendasiController::class, 'index']);
Route::get('/create', [RekomendasiController::class, 'create'])->name('wisata.create');
Route::post('/store', [RekomendasiController::class, 'store'])->name('wisata.store');

//route data objek wisata
Route::get('/dataOwi', [OwiController::class, 'index'])->name('wisata.index');
Route::get('/dataOwi/{$id}', [OwiController::class, 'detailOwi'])->name('wisata.detail');