<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // ================= ADMIN USER =================

    public function index()
    {
        $users = User::all();
        return view('pages.admin.index', compact('users'));
    }

    public function create()
    {
        return view('pages.admin.create');
    }

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

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.edit', compact('user'));
    }

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

    // ================= DASHBOARD =================

    public function dashboard()
    {
        // ===== STATISTIK =====
        $totalBuku = DB::table('buku')->count();
        $totalAnggota = DB::table('anggota')->count();
        $totalPeminjaman = DB::table('peminjaman')->count();
        $totalPengembalian = DB::table('peminjaman')
            ->whereNotNull('tanggal_kembali')
            ->count();

        // ===== PEMINJAMAN PER BULAN =====
        $peminjaman = DB::table('peminjaman')
            ->selectRaw('MONTH(tanggal_pinjam) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // ===== PENGEMBALIAN PER BULAN =====
        $pengembalian = DB::table('peminjaman')
            ->selectRaw('MONTH(tanggal_kembali) as bulan, COUNT(*) as total')
            ->whereNotNull('tanggal_kembali')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // ===== FORMAT 12 BULAN =====
        $peminjamanChart = [];
        $pengembalianChart = [];

        for ($i = 1; $i <= 12; $i++) {
            $peminjamanChart[] = $peminjaman[$i] ?? 0;
            $pengembalianChart[] = $pengembalian[$i] ?? 0;
        }

        return view('pages.dashboard', compact(
            'totalBuku',
            'totalAnggota',
            'totalPeminjaman',
            'totalPengembalian',
            'peminjamanChart',
            'pengembalianChart'
        ));
    }
}