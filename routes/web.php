<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;

Auth::routes();


// ================= SEMUA USER (LOGIN) =================
Route::group(['middleware' => ['auth']], function () {
   Route::get('/home', [AdminController::class, 'dashboard'])->name('home');
});


// ================= ADMIN =================
Route::group(['middleware' => ['auth','role:admin']], function () {
    Route::resource('/admin', AdminController::class);
    Route::resource('/anggota', AnggotaController::class);
    Route::resource('/kategori', KategoriController::class);
     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
   
});

// ================= ADMIN + PETUGAS =================
Route::group(['middleware' => ['auth','role:admin,petugas']], function () {
    Route::resource('/buku', BukuController::class);
});

// ================= PETUGAS =================
Route::group(['middleware' => ['auth','role:petugas']], function () {
  
    Route::resource('/peminjaman', PeminjamanController::class);
    Route::get('/peminjaman/kembali/{id}', [PeminjamanController::class, 'kembali']);
    Route::get('/peminjaman/approve/{id}', [PeminjamanController::class, 'approve']);
    
});


// ================= ANGGOTA =================
Route::group(['middleware' => ['auth','role:anggota']], function () {
    Route::get('/katalog', [UserController::class, 'katalog'])->name('katalog');
    Route::post('/pinjam', [UserController::class, 'pinjam'])->name('pinjam.buku');
    Route::get('/riwayat', [UserController::class, 'riwayat'])->name('riwayat');
});