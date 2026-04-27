@extends('layouts.sbadmin')

@section('title', 'Edit Kategori')

@section('content')

<div class="pt-2 pb-3">
    <h3 class="fw-bold">Edit Kategori</h3>
    <small class="text-muted">Ubah data kategori</small>
</div>

<div class="row">
    <div class="col-md-6">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori"
                               value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                               class="form-control @error('nama_kategori') is-invalid @enderror"
                               placeholder="Contoh: Novel, Komik, Pendidikan">

                        @error('nama_kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update
                        </button>

                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
                            Batal
                        </a>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection