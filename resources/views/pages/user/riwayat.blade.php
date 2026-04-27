@extends('layouts.sbadmin')

@section('title', 'Riwayat Peminjaman')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Riwayat Peminjaman</h3>
        <small class="text-muted">Daftar buku yang pernah dipinjam</small>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Buku</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($peminjaman as $p)
                    <tr>
                        <td class="fw-semibold">{{ $loop->iteration }}</td>

                        <td>
                            <span class="fw-semibold">
                                {{ $p->buku->judul ?? '-' }}
                            </span>
                        </td>

                        <td>
                            @if($p->status == 'dipinjam')
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-clock me-1"></i> Dipinjam
                                </span>
                            @elseif($p->status == 'dikembalikan')
                                <span class="badge bg-success">
                                    <i class="fas fa-check me-1"></i> Dikembalikan
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    {{ $p->status }}
                                </span>
                            @endif
                        </td>

                        <td>
                            @if($p->denda > 0)
                                <span class="text-danger fw-semibold">
                                    Rp {{ number_format($p->denda) }}
                                </span>
                            @else
                                <span class="text-success">
                                    Tidak ada
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            <i class="fas fa-book-open fa-2x mb-2"></i><br>
                            Belum ada riwayat peminjaman
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection