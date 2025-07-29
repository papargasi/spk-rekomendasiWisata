<?php

use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\dashboardControllerController;
use App\Http\Controllers\OwiController;

Route::get('/', [dashboardController::class, 'index']);
Route::get('/rekomendasi', [RekomendasiController::class, 'index']);
Route::get('/create', [RekomendasiController::class, 'create'])->name('wisata.create');
Route::post('/store', [RekomendasiController::class, 'store'])->name('wisata.store');

//route data objek wisata
Route::get('/dataOwi', [OwiController::class, 'index'])->name('wisata.index');
Route::get('/detailOwi/{id}', [OwiController::class, 'detailOwi'])->name('wisata.detail');
Route::get('/edit/detailOwi/{id}', [OwiController::class, 'detailInfoOwi'])->name('wisata.detail.info');
