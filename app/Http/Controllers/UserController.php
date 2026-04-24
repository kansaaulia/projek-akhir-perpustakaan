<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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

    public function pinjam(Request $request)
{
    Peminjaman::create([
        'anggota_id' => auth()->id(),
        'buku_id' => $request->buku_id,
        'tanggal_pinjam' => now(),
        'status' => 'menunggu'
    ]);

    return back()->with('success', 'Request peminjaman berhasil!');
}
}