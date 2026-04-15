@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
<div class="pt-2 pb-3">
    <h3 class="fw-bold">Detail Buku</h3>
</div>

<div class="card card-body">
    <table class="table table-sm table-striped">
        <tr>
            <th width="25%">Kode Buku</th>
            <td>{{ $buku->kode_buku }}</td>
        </tr>
        <tr>
            <th>Judul</th>
            <td>{{ $buku->judul }}</td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td>{{ $buku->kategori->nama_kategori ?? '-' }}</td>
        </tr>
        <tr>
            <th>Penulis</th>
            <td>{{ $buku->penulis }}</td>
        </tr>
        <tr>
            <th>Penerbit</th>
            <td>{{ $buku->penerbit }}</td>
        </tr>
        <tr>
            <th>Tahun Terbit</th>
            <td>{{ $buku->tahun_terbit }}</td>
        </tr>
        <tr>
            <th>Stok</th>
            <td>
                @if ($buku->stok > 0)
                    <span class="text-success">Tersedia ({{ $buku->stok }})</span>
                @else
                    <span class="text-danger">Habis</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Ditambahkan</th>
            <td>{{ \Carbon\Carbon::parse($buku->created_at)->isoFormat('DD/MM/YY HH:mm') }}</td>
        </tr>
        <tr>
            <th>Terakhir Update</th>
            <td>{{ \Carbon\Carbon::parse($buku->updated_at)->isoFormat('DD/MM/YY HH:mm') }}</td>
        </tr>
    </table>

    <div class="d-flex gap-2">
        <a href="{{ route('buku.index') }}" class="btn btn-primary">
            Kembali
        </a>

        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-outline-primary">
            Edit
        </a>

        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger">
                Hapus
            </button>
        </form>
    </div>
</div>
@endsection