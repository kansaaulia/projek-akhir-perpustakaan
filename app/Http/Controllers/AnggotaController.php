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
            'nis_nim' => 'required|unique:anggota,nis_nim',
            'kelas' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required'
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
    return view('pages.anggota.edit', compact('anggota'));
}

// 🔹 UPDATE DATA
public function update(Request $request, string $id)
{
    $anggota = Anggota::findOrFail($id);

    $request->validate([
        'nama' => 'required',
        'nis_nim' => 'required|unique:anggota,nis_nim,' . $id,
        'kelas' => 'required',
        'alamat' => 'required',
        'no_telepon' => 'required'
    ]);

    $anggota->update([
        'nama' => $request->nama,
        'nis_nim' => $request->nis_nim,
        'kelas' => $request->kelas,
        'alamat' => $request->alamat,
        'no_telepon' => $request->no_telepon,
    ]);

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