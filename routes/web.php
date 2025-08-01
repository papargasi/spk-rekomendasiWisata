<?php

use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\OwiController;
use App\Http\Controllers\petaController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\penilaianController;
use App\Http\Controllers\customerController;

Route::get('/', [dashboardController::class, 'index']);
Route::get('/rekomendasi', [RekomendasiController::class, 'index']);
Route::get('/create', [RekomendasiController::class, 'create'])->name('wisata.create');
Route::post('/store', [RekomendasiController::class, 'store'])->name('wisata.store');

//route data objek wisata
Route::get('/dataOwi', [OwiController::class, 'index'])->name('wisata.index');
Route::delete('/dataOwi/{id}/delete', [OwiController::class, 'destroy'])->name('owi.delete');
Route::get('/detailOwi/{id}', [OwiController::class, 'detailOwi'])->name('wisata.detail');
Route::get('/edit/InfodetailOwi/{id}', [OwiController::class, 'detailInfoOwi'])->name('wisata.detail.info');
Route::get('/edit/RatingdetailOwi/{id}', [OwiController::class, 'detailRatingOwi'])->name('wisata.detail.rating');
Route::get('/edit/FotodetailOwi/{id}', [OwiController::class, 'detailFotoOwi'])->name('wisata.detail.foto');
Route::put('Infoupdate/wisata/{id}', [RekomendasiController::class, 'updateInfo'])->name('wisata.updateInfo');
Route::put('Ratingupdate/wisata/{id}', [RekomendasiController::class, 'updateRating'])->name('wisata.updateRating');
Route::put('/foto/{id}/update', [RekomendasiController::class, 'updateSingleFoto'])->name('foto.update');
Route::post('/foto/{id}/tambah', [RekomendasiController::class, 'tambahFoto'])->name('foto.tambah');
Route::delete('/foto/{id}/delete', [RekomendasiController::class, 'deleteFoto'])->name('foto.delete');


Route::get('/konfigurasi-peta', [petaController::class, 'index'])->name('peta');
Route::get('/kategori', [kategoriController::class, 'index'])->name('kategori');
Route::get('/penilaian', [penilaianController::class, 'index'])->name('penilaian');

//route halaman customer
Route::get('/customer', [customerController::class, 'index'])->name('customer');
Route::get('/customer-detail/{id}', [customerController::class, 'detail'])->name('detail');