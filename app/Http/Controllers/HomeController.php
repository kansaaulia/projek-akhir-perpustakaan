<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  public function index()
{
    if (auth()->user()->role == 'admin') {

        $users = User::all(); 
        $buku = Buku::count();
        $peminjaman = Peminjaman::count();

        return view('pages.admin.index', compact('users','buku','peminjaman'));

    } elseif (auth()->user()->role == 'petugas') {
        return redirect('/peminjaman');
    } else {
        return redirect('/katalog');
    }
}
}
