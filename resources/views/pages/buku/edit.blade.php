@extends('layouts.sbadmin')

@section('title', 'Edit Buku')

@section('content')

<div class="pt-2 pb-3">
    <h3 class="fw-bold">Edit Buku</h3>
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

            <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- KODE BUKU --}}
                <div class="mb-3">
                    <label>Kode Buku</label>
                    <input type="text" name="kode_buku"
                        value="{{ old('kode_buku', $buku->kode_buku) }}"
                        class="form-control">
                </div>

                {{-- JUDUL --}}
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul"
                        value="{{ old('judul', $buku->judul) }}"
                        class="form-control">
                </div>

                {{-- COVER --}}
                <div class="mb-3">
    <label>Cover</label>

    {{-- GAMBAR LAMA --}}
    <div class="mb-2">
        @if($buku->cover)
            <img src="{{ asset('cover/'.$buku->cover) }}"
                 width="90"
                 class="rounded shadow-sm mb-2">

            <div class="text-muted small">
                File saat ini: {{ $buku->cover }}
            </div>
        @else
            <span class="text-muted">Belum ada cover</span>
        @endif
    </div>

    {{-- INPUT FILE BARU --}}
    <input type="file" name="cover" class="form-control">

    {{-- OPTIONAL INFO --}}
    <small class="text-muted">
        Kosongkan jika tidak ingin mengganti cover
    </small>
</div>

                {{-- PENULIS --}}
                <div class="mb-3">
                    <label>Penulis</label>
                    <input type="text" name="penulis"
                        value="{{ old('penulis', $buku->penulis) }}"
                        class="form-control">
                </div>

                {{-- PENERBIT --}}
                <div class="mb-3">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit"
                        value="{{ old('penerbit', $buku->penerbit) }}"
                        class="form-control">
                </div>

                {{-- TAHUN --}}
                <div class="mb-3">
                    <label>Tahun Terbit</label>
                    <input type="number" name="tahun_terbit"
                        value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                        class="form-control">
                </div>

                {{-- KATEGORI --}}
                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="kategori_id" class="form-control">
                        <option value="">-- Pilih Kategori --</option>

                        @foreach ($kategori as $k)
                            <option value="{{ $k->id }}"
                                {{ old('kategori_id', $buku->kategori_id) == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- STOK --}}
                <div class="mb-3">
                    <label>Stok</label>
                    <input type="number" name="stok"
                        value="{{ old('stok', $buku->stok) }}"
                        class="form-control">
                </div>

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