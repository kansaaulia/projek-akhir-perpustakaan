@extends('layouts.sbadmin')

@section('title', 'Katalog Buku')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Katalog Buku</h3>
        <small class="text-muted">Jelajahi koleksi buku yang tersedia</small>
    </div>
</div>

<div class="row">
    @forelse($buku as $item)
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm border-0 katalog-card">

            {{-- COVER --}}
            <div class="position-relative">
                @if($item->cover)
                    <img src="{{ asset('cover/'.$item->cover) }}"
                         class="card-img-top"
                         style="height:220px; object-fit:cover;">
                @else
                    <img src="https://via.placeholder.com/300x220"
                         class="card-img-top">
                @endif

                {{-- BADGE STOK --}}
                <span class="badge 
                    {{ $item->stok > 0 ? 'bg-success' : 'bg-danger' }}
                    position-absolute top-0 end-0 m-2">
                    {{ $item->stok > 0 ? 'Tersedia' : 'Habis' }}
                </span>
            </div>

            <div class="card-body d-flex flex-column">

                <h6 class="fw-bold mb-1 text-truncate">
                    {{ $item->judul }}
                </h6>

                <small class="text-muted mb-2">
                    {{ $item->penulis }}
                </small>

                <div class="mb-2">
                    <span class="badge bg-light text-dark border">
                        <i class="fas fa-tag me-1"></i>
                        {{ $item->kategori->nama_kategori ?? '-' }}
                    </span>
                </div>

                <div class="mb-3">
                    @if($item->stok > 0)
                        <small class="text-success">
                            <i class="fas fa-check-circle me-1"></i>
                            Stok: {{ $item->stok }}
                        </small>
                    @else
                        <small class="text-danger">
                            <i class="fas fa-times-circle me-1"></i>
                            Stok habis
                        </small>
                    @endif
                </div>

                {{-- BUTTON --}}
                <div class="mt-auto">
                    @if($item->stok > 0)
                        <form action="{{ route('pinjam.buku') }}" method="POST">
                            @csrf
                            <input type="hidden" name="buku_id" value="{{ $item->id }}">

                            <button type="submit"
                                class="btn btn-primary w-100 btn-sm shadow-sm">
                                <i class="fas fa-book-reader me-1"></i> Pinjam
                            </button>
                        </form>
                    @else
                        <button class="btn btn-secondary w-100 btn-sm" disabled>
                            Tidak tersedia
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5 text-muted">
        <i class="fas fa-book-open fa-2x mb-2"></i><br>
        Belum ada buku tersedia
    </div>
    @endforelse
</div>

@endsection

@push('styles')
<style>
.katalog-card {
    transition: 0.2s ease;
}
.katalog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
</style>
@endpush