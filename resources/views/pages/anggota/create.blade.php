@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')

<div class="pt-2 pb-3">
    <h3 class="fw-bold">Tambah Anggota</h3>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-body">

            <form action="{{ route('anggota.store') }}" method="POST">
                @csrf

                {{-- NAMA --}}
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" 
                        value="{{ old('nama') }}" 
                        class="form-control @error('nama') is-invalid @enderror"
                        placeholder="Masukkan nama">

                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NIS --}}
                <div class="mb-3">
                    <label class="form-label">NIS</label>
                    <input type="text" name="nis_nim" 
                        value="{{ old('nis_nim') }}" 
                        class="form-control @error('nis_nim') is-invalid @enderror"
                        placeholder="Masukkan NIS">

                    @error('nis_nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KELAS --}}
                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <input type="text" name="kelas" 
                        value="{{ old('kelas') }}" 
                        class="form-control @error('kelas') is-invalid @enderror"
                        placeholder="Contoh: XI RPL 1">

                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ALAMAT --}}
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" 
                        class="form-control @error('alamat') is-invalid @enderror"
                        placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>

                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NO TELP --}}
                <div class="mb-3">
                    <label class="form-label">No Telepon</label>
                    <input type="text" name="no_telp" 
                        value="{{ old('no_telp') }}" 
                        class="form-control @error('no_telp') is-invalid @enderror"
                        placeholder="Masukkan nomor telepon">

                    @error('no_telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <button type="submit" class="btn btn-primary">
                    <span class="fas fa-save"></span> Simpan
                </button>

                <a href="{{ route('anggota.index') }}" class="btn btn-secondary ms-2">
                    Batal
                </a>

            </form>

        </div>
    </div>
</div>

@endsection