@extends('layouts.sbadmin')
@section('title', 'Tambah Admin')

@section('content')
    <div class="pt-2 pb-3">
        <h3 class="fw-bold">Edit Admin</h3>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-body">
                <form action="{{ route('admin.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" value="{{ old('name') ?? $user->name }}" class="form-control @error('name') is-invalid @enderror"  placeholder="Masukkan nama">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') ?? $user->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password" >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class=" form-group mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Masukkan konfirmasi password" >
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary"><span class="fa fa-plus">Simpan</span></button>

                    <a href="{{ route('admin.index') }}" class="btn btn-secondary ms-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection