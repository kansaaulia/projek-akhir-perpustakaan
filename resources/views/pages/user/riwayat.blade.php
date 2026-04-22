@extends('layouts.sbadmin')

@section('title', 'Riwayat Peminjaman')

@section('content')

<h3 class="fw-bold mb-4">Riwayat Peminjaman</h3>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Buku</th>
        <th>Status</th>
        <th>Denda</th>
    </tr>

    @foreach($peminjaman as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->buku->judul }}</td>
        <td>{{ $p->status }}</td>
        <td>Rp {{ number_format($p->denda) }}</td>
    </tr>
    @endforeach

</table>

@endsection