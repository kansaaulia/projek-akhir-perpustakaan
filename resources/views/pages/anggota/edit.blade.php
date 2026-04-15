@extends('layouts.app')
@section('title', 'Edit Anggota')

@section('content')
<div class="pt-2 pb-3">
    <h3 class="fw-bold">Edit Anggota</h3>
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

            <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- NAMA --}}
                <div class="form-group mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama"
                        value="{{ old('nama', $anggota->nama) }}"
                        class="form-control @error('nama') is-invalid @enderror"
                        placeholder="Masukkan nama">

                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NIS --}}
                <div class="form-group mb-3">
                    <label class="form-label">NIS</label>
                    <input type="text" name="nis_nim"
                        value="{{ old('nis_nim', $anggota->nis_nim) }}"
                        class="form-control @error('nis_nim') is-invalid @enderror"
                        placeholder="Masukkan NIS">

                    @error('nis_nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
    <label class="form-label">Kelas</label>
    <input type="text" name="kelas"
        value="{{ old('kelas', $anggota->kelas) }}"
        class="form-control @error('kelas') is-invalid @enderror"
        placeholder="Masukkan kelas">

    @error('kelas')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                {{-- ALAMAT --}}
                <div class="form-group mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat"
                        value="{{ old('alamat', $anggota->alamat) }}"
                        class="form-control @error('alamat') is-invalid @enderror"
                        placeholder="Masukkan alamat">

                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NO TELEPON --}}
                <div class="form-group mb-3">
                    <label class="form-label">No Telepon</label>
                    <input type="text" name="no_telepon"
                        value="{{ old('no_telepon', $anggota->no_telepon) }}"
                        class="form-control @error('no_telepon') is-invalid @enderror"
                        placeholder="Masukkan no telepon">

                    @error('no_telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('anggota.index') }}" class="btn btn-secondary ms-2">
                    Batal
                </a>
            </form>
        </div>
    </div>
</div>
@endsection