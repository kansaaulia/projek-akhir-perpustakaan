<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    
    public function index()
    {
        $anggota = Anggota::all();
        return view('pages.anggota.index', compact('anggota'));
    }

    
    public function create()
    {
        return view('pages.anggota.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nis_nim' => 'required|unique:anggota,nis',
            'kelas' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);

        Anggota::create($request->all());

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil ditambahkan');
    }

    
    public function show(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('pages.anggota.show', compact('anggota'));
    }

    // 🔹 FORM EDIT
    public function edit(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

   
    public function update(Request $request, string $id)
    {
        $anggota = Anggota::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:anggota,nis,' . $id,
            'kelas' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ]);

        $anggota->update($request->all());

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil diupdate');
    }

    
    public function destroy(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil dihapus');
    }
}