@extends('layouts.sbadmin')

@section('title', 'Katalog Buku')

@section('content')

<h3 class="fw-bold mb-4">Katalog Buku</h3>

<div class="row">
    @foreach($buku as $item)
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm">

            {{-- COVER --}}
            @if($item->cover)
                <img src="{{ asset('cover/'.$item->cover) }}" 
                     style="height:200px; object-fit:cover;">
            @else
                <img src="https://via.placeholder.com/150x200" 
                     style="height:200px;">
            @endif

            <div class="card-body">
                <h6 class="fw-bold">{{ $item->judul }}</h6>
                <small class="text-muted">{{ $item->penulis }}</small>

                <div class="mt-2">
                    <span class="badge bg-info">
                        {{ $item->kategori->nama_kategori ?? '-' }}
                    </span>
                </div>

                <div class="mt-2">
                    @if($item->stok > 0)
                        <span class="text-success">Tersedia</span>
                    @else
                        <span class="text-danger">Habis</span>
                    @endif
                </div>
            </div>

        </div>
    </div>
    @endforeach
</div>

@endsection