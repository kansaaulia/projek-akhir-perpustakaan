@extends('layouts.sbadmin')

@section('title', 'Detail Buku')

@section('content')

<div class="pt-2 pb-3">
    <h3 class="fw-bold">Detail Buku</h3>
</div>

<div class="card card-body">

    <table class="table table-sm table-striped">
        <tr>
            <th width="25%">Kode Buku</th>
            <td>{{ $buku->kode_buku }}</td>
        </tr>

        <tr>
            <th>Judul</th>
            <td>{{ $buku->judul }}</td>
        </tr>

    <tr>
    <th>Cover</th>
    <td>
        @if ($buku->cover)
            <div class="d-flex align-items-start gap-3">

                {{-- GAMBAR --}}
                <img src="{{ asset('cover/'.$buku->cover) }}"
                     width="120"
                     class="rounded shadow-sm">

                {{-- INFO FILE --}}
                <div>
                    <div class="fw-semibold">Cover tersedia</div>
                    <div class="text-muted small">
                        {{ $buku->cover }}
                    </div>
                </div>

            </div>
        @else
            <span class="text-muted">
                <i class="fas fa-image me-1"></i>
                Tidak ada cover
            </span>
        @endif
    </td>
</tr>

        <tr>
            <th>Kategori</th>
            <td>{{ $buku->kategori->nama_kategori ?? '-' }}</td>
        </tr>

        <tr>
            <th>Penulis</th>
            <td>{{ $buku->penulis }}</td>
        </tr>

        <tr>
            <th>Penerbit</th>
            <td>{{ $buku->penerbit }}</td>
        </tr>

        <tr>
            <th>Tahun Terbit</th>
            <td>{{ $buku->tahun_terbit }}</td>
        </tr>

        <tr>
            <th>Stok</th>
            <td>
                @if ($buku->stok > 0)
                    <span class="text-success fw-semibold">
                        Tersedia ({{ $buku->stok }})
                    </span>
                @else
                    <span class="text-danger fw-semibold">
                        Habis
                    </span>
                @endif
            </td>
        </tr>

        <tr>
            <th>Ditambahkan</th>
            <td>{{ $buku->created_at->format('d/m/Y H:i') }}</td>
        </tr>

        <tr>
            <th>Terakhir Update</th>
            <td>{{ $buku->updated_at->format('d/m/Y H:i') }}</td>
        </tr>

    </table>

    <div class="d-flex gap-2">

        <a href="{{ route('buku.index') }}" class="btn btn-primary">
            Kembali
        </a>


      

    </div>

</div>

@endsection