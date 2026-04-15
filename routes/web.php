<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/admin',   App\Http\Controllers\AdminController::class);
    Route::resource('/anggota', App\Http\Controllers\AnggotaController::class);
    Route::resource('/buku', App\Http\Controllers\BukuController::class);
    Route::resource('/kategori', App\Http\Controllers\KategoriController::class);
    Route::resource('/peminjaman', App\Http\Controllers\PeminjamanController::class);
});

