@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')

<div class="pt-2 pb-3">
    <h3 class="fw-bold">Tambah Buku</h3>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-body">

            {{-- ERROR GLOBAL --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('buku.store') }}" method="POST">
                @csrf

                {{-- KODE BUKU --}}
                <div class="form-group mb-3">
                    <label class="form-label">Kode Buku</label>
                    <input type="text" name="kode_buku"
                        value="{{ old('kode_buku') }}"
                        class="form-control @error('kode_buku') is-invalid @enderror"
                        placeholder="Masukkan kode buku">

                    @error('kode_buku')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- JUDUL --}}
                <div class="form-group mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul"
                        value="{{ old('judul') }}"
                        class="form-control @error('judul') is-invalid @enderror"
                        placeholder="Masukkan judul buku">

                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PENULIS --}}
                <div class="form-group mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis"
                        value="{{ old('penulis') }}"
                        class="form-control @error('penulis') is-invalid @enderror"
                        placeholder="Masukkan penulis">

                    @error('penulis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PENERBIT --}}
                <div class="form-group mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit"
                        value="{{ old('penerbit') }}"
                        class="form-control @error('penerbit') is-invalid @enderror"
                        placeholder="Masukkan penerbit">

                    @error('penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TAHUN TERBIT --}}
                <div class="form-group mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit"
                        value="{{ old('tahun_terbit') }}"
                        class="form-control @error('tahun_terbit') is-invalid @enderror"
                        placeholder="Contoh: 2020">

                    @error('tahun_terbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KATEGORI --}}
             <div class="form-group mb-3">
    <label class="form-label">Kategori</label>
    <select name="kategori_id" 
        class="form-control @error('kategori_id') is-invalid @enderror">
        
        <option value="">-- Pilih Kategori --</option>

        @foreach ($kategori as $k)
            <option value="{{ $k->id }}" 
                {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                {{ $k->nama_kategori }}
            </option>
        @endforeach

    </select>

    @error('kategori_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                {{-- STOK --}}
                <div class="form-group mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok"
                        value="{{ old('stok') }}"
                        class="form-control @error('stok') is-invalid @enderror"
                        placeholder="Masukkan jumlah stok">

                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('buku.index') }}" class="btn btn-secondary ms-2">
                    Batal
                </a>
            </form>

        </div>
    </div>
</div>

@endsection