<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Support\Facades\File;

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
            'cover' => 'nullable|image|mimes:jpg,jpeg,jfif,png|max:2048',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required'
        ]);

        $data = $request->all();

        // UPLOAD COVER
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            // simpan ke public/cover
            $file->move(public_path('cover'), $fileName);

            $data['cover'] = $fileName;
        }

        Buku::create($data);

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
            'cover' => 'nullable|image|mimes:jpg,jpeg,jfif,png|max:2048',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required'
        ]);

        $data = $request->all();

        // UPDATE COVER
        if ($request->hasFile('cover')) {

            // hapus cover lama
            if ($buku->cover && File::exists(public_path('cover/'.$buku->cover))) {
                File::delete(public_path('cover/'.$buku->cover));
            }

            $file = $request->file('cover');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('cover'), $fileName);

            $data['cover'] = $fileName;
        }

        $buku->update($data);

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil diupdate');
    }

    public function destroy(string $id)
{
    
    // 🔒 hanya admin yang boleh hapus
   if (!in_array(auth()->user()->role, ['admin'])) {
    abort(403, 'Hanya admin yang bisa menghapus buku');
}

    $buku = Buku::findOrFail($id);

    // hapus cover juga
    if ($buku->cover && \File::exists(public_path('cover/' . $buku->cover))) {
        \File::delete(public_path('cover/' . $buku->cover));
    }

    $buku->delete();

    return redirect()->route('buku.index')
        ->with('success', 'Data buku berhasil dihapus');
}
}