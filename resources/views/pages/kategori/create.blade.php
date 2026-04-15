@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<h3>Tambah Kategori</h3>

<form action="{{ route('kategori.store') }}" method="POST">
    @csrf

    <input type="text" name="nama_kategori" placeholder="Nama Kategori">

    <button type="submit">Simpan</button>
</form>

@endsection