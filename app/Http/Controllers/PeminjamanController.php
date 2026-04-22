<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use Carbon\Carbon;
use App\Models\Anggota;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('anggota','buku')->get();
        return view('pages.peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $anggota = Anggota::all();
        $buku = Buku::all();

        return view('pages.peminjaman.create', compact('anggota','buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required',
            'buku_id' => 'required',
             'tanggal_pinjam' => 'required|date',
        ]);

        $buku = Buku::find($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }

        Peminjaman::create([
            'anggota_id' => $request->anggota_id,
            'buku_id' => $request->buku_id,
           'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'dipinjam',
            
        ]);

        $buku->decrement('stok');

        return redirect('/peminjaman')->with('success', 'Berhasil meminjam buku!');
    }

    
public function kembali($id)
{
    $p = Peminjaman::find($id);

    $tanggalPinjam = Carbon::parse($p->tanggal_pinjam);
    $sekarang = Carbon::now();

    // batas pinjam 7 hari
    $batas = $tanggalPinjam->copy()->addDays(3);

    $denda = 0;

    if ($sekarang->gt($batas)) {
        $telat = $batas->diffInDays($sekarang);
        $denda = $telat * 500; // Rp500 per hari
    }

    $p->status = 'dikembalikan';
    $p->tanggal_kembali = $sekarang;
    $p->denda = $denda;
    $p->save();

    $p->buku->increment('stok');

    return back()->with('success', 'Buku dikembalikan. Denda: Rp ' . number_format($denda));
}
}