@extends('layouts.sbadmin')

@section('title', 'Data Buku')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Data Buku</h3>
        <small class="text-muted">Manajemen koleksi buku</small>
    </div>

    <a href="{{ route('buku.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus me-2"></i> Tambah Buku
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle datatable mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Kode</th>
                        <th>Judul</th>
                        <th class="text-center">Cover</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th class="text-center" width="170">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($buku as $item)
                    <tr>
                        <td class="fw-semibold">{{ $loop->iteration }}</td>

                        <td>
                            <span class="badge bg-secondary">
                                {{ $item->kode_buku }}
                            </span>
                        </td>

                        <td class="fw-semibold">
                            {{ $item->judul }}
                        </td>

                        <td class="text-center">
                            @if($item->cover)
                                <img src="{{ asset('cover/'.$item->cover) }}"
                                     width="50"
                                     class="rounded shadow-sm">
                            @else
                                <span class="text-muted small">Tidak ada</span>
                            @endif
                        </td>

                        <td>
                            <i class="fas fa-tag text-primary me-1"></i>
                            {{ $item->kategori->nama_kategori ?? '-' }}
                        </td>

                        <td>{{ $item->penulis }}</td>

                        <td>
                            <span class="badge bg-light text-dark">
                                {{ $item->tahun_terbit }}
                            </span>
                        </td>

                        <td>
                            @if ($item->stok > 0)
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i>
                                    {{ $item->stok }}
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    <i class="fas fa-times-circle me-1"></i>
                                    Habis
                                </span>
                            @endif
                        </td>

                        <td class="text-center">

                            <!-- DETAIL -->
                            <a href="{{ route('buku.show', $item->id) }}"
                               class="btn btn-sm btn-info text-white me-1">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- EDIT -->
                            <a href="{{ route('buku.edit', $item->id) }}"
                               class="btn btn-sm btn-warning text-white me-1">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- DELETE -->
                            <button type="button"
                                    onclick="confirmDelete(this)"
                                    data-url="{{ route('buku.destroy', $item->id) }}"
                                    class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">
                            <i class="fas fa-book-open fa-2x mb-2"></i><br>
                            Data buku masih kosong
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection


{{-- ================= SCRIPT SECTION ================= --}}
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(button) {
    let url = button.getAttribute('data-url');

    Swal.fire({
        title: 'Yakin hapus data?',
        text: "Data buku akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {

            let form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            let csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';

            let method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';

            form.appendChild(csrf);
            form.appendChild(method);

            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>

@endpush