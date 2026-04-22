<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function katalog()
    {
        $buku = Buku::with('kategori')->get();
        return view('pages.user.katalog', compact('buku'));
    }

    public function riwayat()
    {
        $peminjaman = Peminjaman::with('buku')
            ->where('anggota_id', Auth::user()->id)
            ->get();

        return view('pages.user.riwayat', compact('peminjaman'));
    }
}