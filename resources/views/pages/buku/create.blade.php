@extends('layouts.sbadmin')

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

          <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
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

                <div class="mb-3">
    <label for="cover" class="form-label">Cover</label>

    {{-- PREVIEW --}}
    <div class="mb-2">
        <img id="preview-cover"
             src="#"
             alt="Preview"
             style="display:none; width:100px;"
             class="rounded shadow-sm">
        
        <div id="no-preview" class="text-muted small">
            Belum ada cover dipilih
        </div>
    </div>

    {{-- INPUT FILE --}}
    <input type="file" name="cover" id="cover"
           class="form-control"
           onchange="previewCover(event)">

    @error('cover')
        <div class="text-danger">{{ $message }}</div>
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
@push('scripts')
<script>
function previewCover(event) {
    const input = event.target;
    const preview = document.getElementById('preview-cover');
    const noPreview = document.getElementById('no-preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            noPreview.style.display = 'none';
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush