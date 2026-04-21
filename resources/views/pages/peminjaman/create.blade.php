@extends('layouts.sbadmin')

@section('title', 'Tambah Peminjaman')

@section('content')

<div class="pt-2 pb-3">
    <h3 class="fw-bold">Tambah Peminjaman</h3>
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

            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf

                {{-- ANGGOTA --}}
                <div class="form-group mb-3">
                    <label class="form-label">Anggota</label>
                    <select name="anggota_id"
                        class="form-control @error('anggota_id') is-invalid @enderror">

                        <option value="">-- Pilih Anggota --</option>

                        @foreach ($anggota as $a)
                            <option value="{{ $a->id }}"
                                {{ old('anggota_id') == $a->id ? 'selected' : '' }}>
                                {{ $a->nama }}
                            </option>
                        @endforeach

                    </select>

                    @error('anggota_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUKU --}}
                <div class="form-group mb-3">
                    <label class="form-label">Buku</label>
                    <select name="buku_id"
                        class="form-control @error('buku_id') is-invalid @enderror">

                        <option value="">-- Pilih Buku --</option>

                        @foreach ($buku as $b)
                            <option value="{{ $b->id }}"
                                {{ old('buku_id') == $b->id ? 'selected' : '' }}>
                                {{ $b->judul }} (stok: {{ $b->stok }})
                            </option>
                        @endforeach

                    </select>

                    @error('buku_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TANGGAL PINJAM --}}
                <div class="form-group mb-3">
                    <label class="form-label">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam"
                        value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                        class="form-control @error('tanggal_pinjam') is-invalid @enderror">

                    @error('tanggal_pinjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary ms-2">
                    Batal
                </a>

            </form>

        </div>
    </div>
</div>

@endsection