@extends('layouts.app')

@section('content')

<style>
/* ===== WARNA COKLAT THEME ===== */
.text-brown {
    color: #5d4037;
}

.btn-brown {
    background-color: #8d6e63;
    color: #fff;
    border: none;
    transition: 0.2s;
}

.btn-brown:hover {
    background-color: #6d4c41;
    color: #fff;
    transform: translateY(-1px);
}

.btn-brown:focus {
    box-shadow: 0 0 0 0.2rem rgba(141,110,99,0.4);
}

.form-control:focus {
    border-color: #8d6e63;
    box-shadow: 0 0 0 0.15rem rgba(141,110,99,.25);
}

label {
    color: #5d4037;
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
                    <h2 class="fw-bold">Selamat Datang </h2>
                    <p>Masuk untuk mengakses perpustakaan digital</p>
                </div>
            </div>
        </div>

        <!-- KANAN (FORM) -->
        <div class="col-md-6 d-flex align-items-center justify-content-center"
             style="background: linear-gradient(135deg, #ccaf92, #f0edcd);">

            <div class="p-4 rounded-4 shadow bg-white"
                 style="width: 80%; max-width: 420px;">

                <h3 class="fw-bold mb-1 text-brown">Login</h3>
                <small class="text-muted">Masuk ke akun kamu</small>

                <form method="POST" action="{{ route('login') }}" class="mt-4">
                    @csrf

                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <label>Email</label>
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
                        <label>Password</label>
                        <input type="password" name="password"
                            class="form-control rounded-3 @error('password') is-invalid @enderror"
                            placeholder="Masukkan password">

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- REMEMBER --}}
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>

                    {{-- BUTTON --}}
                    <button class="btn btn-brown w-100 rounded-3 shadow-sm">
                        Login
                    </button>

                    {{-- LINK --}}
                    <div class="text-center mt-3">
                        <small>
                            Belum punya akun?
                            <a href="{{ route('register') }}" style="color:#8d6e63;" class="fw-semibold">
                                Register
                            </a>
                        </small>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-center mt-2">
                            <a href="{{ route('password.request') }}" class="text-muted small">
                                Lupa password?
                            </a>
                        </div>
                    @endif

                </form>

            </div>
        </div>

    </div>
</div>

@endsection