<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('pages.admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'role' => 'required|in:admin,petugas,anggota',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'role' => 'required|in:admin,petugas,anggota',
        ]);

        $data = $request->only('name', 'email', 'role');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->id == auth()->id()) {
            return back()->with('error', 'Tidak bisa hapus akun sendiri');
        }

        $user->delete();

        return redirect()->route('admin.index')
            ->with('success', 'Data berhasil dihapus');
    }

    /**
     * Dashboard
     */
    public function dashboard()
    {
        // ================= CHART PEMINJAMAN =================
        $data = array_fill(1, 12, 0);

        $result = Peminjaman::selectRaw('MONTH(tanggal_pinjam) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->get();

        foreach ($result as $r) {
            $data[$r->bulan] = $r->total;
        }

        $peminjamanChart = array_values($data);


        // ================= CHART PENGEMBALIAN =================
        $data2 = array_fill(1, 12, 0);

        $result2 = Peminjaman::selectRaw('MONTH(tanggal_kembali) as bulan, COUNT(*) as total')
            ->whereNotNull('tanggal_kembali')
            ->groupBy('bulan')
            ->get();

        foreach ($result2 as $r) {
            $data2[$r->bulan] = $r->total;
        }

        $pengembalianChart = array_values($data2);


        // ================= STATISTIK =================
        $totalBuku = Buku::count();
        $totalAnggota = Anggota::count();
        $dipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $belumKembali = Peminjaman::whereNull('tanggal_kembali')->count();


        // ================= DATA TABEL =================
        $peminjaman = Peminjaman::with('anggota', 'buku')
            ->latest()
            ->take(10)
            ->get();


        return view('pages.dashboard', compact(
            'peminjamanChart',
            'pengembalianChart',
            'totalBuku',
            'totalAnggota',
            'dipinjam',
            'belumKembali',
            'peminjaman'
        ));
    }
}