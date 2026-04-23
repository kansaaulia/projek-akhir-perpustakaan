@extends('layouts.sbadmin')

@section('title', 'Data Peminjaman')

@section('content')

<div class="pt-2 pb-3">
    <h3 class="fw-bold">Data Peminjaman</h3>
</div>

<div class="card">
    <div class="card-body">

        {{-- ALERT --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- BUTTON TAMBAH --}}
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">
            + Tambah Peminjaman
        </a>

        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">

                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($peminjaman as $p)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>

                        <td>{{ $p->anggota->nama }}</td>

                        <td>{{ $p->buku->judul }}</td>

                        <td>{{ $p->tanggal_pinjam }}</td>

                        <td>
                            {{ $p->tanggal_kembali ?? '-' }}
                        </td>

                        {{-- STATUS --}}
                        <td class="text-center">
                            @if($p->status == 'menunggu')
                                <span class="badge bg-secondary">Menunggu</span>
                            @elseif($p->status == 'dipinjam')
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            @else
                                <span class="badge bg-success">Dikembalikan</span>
                            @endif
                        </td>

                        {{-- DENDA --}}
                        <td class="text-center">
                            @if($p->denda > 0)
                                <span class="text-danger fw-bold">
                                    Rp {{ number_format($p->denda) }}
                                </span>
                            @else
                                -
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="text-center">

                            @if($p->status == 'menunggu')
                                <a href="/peminjaman/approve/{{ $p->id }}" 
                                   class="btn btn-success btn-sm">
                                   Setujui
                                </a>

                            @elseif($p->status == 'dipinjam')
                                <a href="/peminjaman/kembali/{{ $p->id }}"
                                   class="btn btn-primary btn-sm">
                                   Kembalikan
                                </a>

                            @else
                                <span class="text-muted">Selesai</span>
                            @endif

                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            Belum ada data peminjaman
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection