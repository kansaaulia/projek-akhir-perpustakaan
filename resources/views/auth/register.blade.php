@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f5f2ee;
    }

    .text-brown {
        color: #5a3e1b;
    }

    .btn-brown {
        background: #5a3e1b;
        color: white;
        border: none;
        transition: 0.3s;
    }

    .btn-brown:hover {
        background: #3e2a12;
        color: white;
    }

    .form-control:focus {
        border-color: #c0a385;
        box-shadow: 0 0 0 0.15rem rgba(192, 163, 133, 0.4);
    }
</style>

<div class="container-fluid">
    <div class="row vh-100">

        <!-- KIRI (GAMBAR) -->
        <div class="col-md-6 d-none d-md-block p-0">
            <div style="
                background-image: url('{{ asset('images/download (16).jfif') }}');
                background-size: cover;
                background-position: center;
                height: 100vh;
                position: relative;
            ">

                <!-- overlay -->
                <div style="
                    position:absolute;
                    top:0;
                    left:0;
                    width:100%;
                    height:100%;
                    background: rgba(0,0,0,0.5);
                "></div>

                <!-- text -->
                <div class="position-absolute top-50 start-50 translate-middle text-white text-center px-4">
                    <h2 class="fw-bold">Perpustakaan Digital</h2>
                    <p>Gabung sekarang & nikmati akses buku </p>
                </div>
            </div>
        </div>

        <!-- KANAN (FORM) -->
        <div class="col-md-6 d-flex align-items-center justify-content-center"
             style="background: linear-gradient(135deg, #c0a385, #61370d);">

            <div class="p-4 rounded-4 shadow-lg bg-white"
                 style="width: 80%; max-width: 420px;">

                <h3 class="fw-bold mb-1 text-brown">Register</h3>
                <small class="text-muted">Buat akun baru</small>

                <form method="POST" action="{{ route('register') }}" class="mt-4">
                    @csrf

                    {{-- NAMA --}}
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name"
                            value="{{ old('name') }}"
                            class="form-control rounded-3 @error('name') is-invalid @enderror"
                            placeholder="Masukkan nama">

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                            value="{{ old('email') }}"
                            class="form-control rounded-3 @error('email') is-invalid @enderror"
                            placeholder="Masukkan email">

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                            class="form-control rounded-3 @error('password') is-invalid @enderror"
                            placeholder="Masukkan password">

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KONFIRMASI --}}
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                            class="form-control rounded-3"
                            placeholder="Ulangi password">
                    </div>

                    {{-- ROLE --}}
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-control rounded-3">
                            <option value="anggota">Anggota</option>
                            <option value="petugas">Petugas</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    {{-- BUTTON --}}
                    <button class="btn btn-brown w-100 rounded-3 shadow-sm">
                        Register
                    </button>

                    {{-- LINK --}}
                    <div class="text-center mt-3">
                        <small>
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="fw-semibold text-brown">
                                Login
                            </a>
                        </small>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection