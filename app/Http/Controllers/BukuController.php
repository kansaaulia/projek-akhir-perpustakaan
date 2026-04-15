<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class BukuController extends Controller
{
    
    public function index()
    {
        $buku = Buku::with('kategori')->get();
        return view('pages.buku.index', compact('buku'));
    }

    
    public function create()
    {
        $kategori = Kategori::all();
        return view('pages.buku.create', compact('kategori'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku',
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required'
        ]);

        Buku::create($request->all());

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil ditambahkan');
    }

    
    public function show(string $id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);
        return view('pages.buku.show', compact('buku'));
    }

    
    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();
        return view('pages.buku.edit', compact('buku', 'kategori'));
    }

   
    public function update(Request $request, string $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku,' . $id,
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required'
        ]);

        $buku->update([
            'kode_buku' => $request->kode_buku,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
        ]);

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil diupdate');
    }

    
    public function destroy(string $id)
    {
        $buku = Buku::findOrFail($id);

        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil dihapus');
    }
}