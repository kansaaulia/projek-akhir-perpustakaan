@extends('layouts.sbadmin')

@section('title', 'Data Anggota')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Data Anggota</h3>
        <small class="text-muted">Manajemen data anggota perpustakaan</small>
    </div>

    <a href="{{ route('anggota.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus me-2"></i> Tambah Anggota
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle datatable mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
                        <th class="text-center" width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($anggota as $item)
                    <tr>
                        <td class="fw-semibold">{{ $loop->iteration }}</td>

                        <td class="fw-semibold">
                            {{ $item->nama }}
                        </td>

                        <td>
                            <span class="badge bg-secondary">
                                {{ $item->nis_nim }}
                            </span>
                        </td>

                        <td>{{ $item->kelas }}</td>

                        <td class="text-muted small">
                            {{ $item->alamat }}
                        </td>

                        <td>{{ $item->no_telepon }}</td>

                        <td class="text-center">

                            <!-- DETAIL -->
                            <a href="{{ route('anggota.show', $item->id) }}"
                               class="btn btn-sm btn-info text-white me-1">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- EDIT -->
                            <a href="{{ route('anggota.edit', $item->id) }}"
                               class="btn btn-sm btn-warning text-white me-1">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- DELETE -->
                            <button type="button"
                                    onclick="confirmDelete(this)"
                                    data-url="{{ route('anggota.destroy', $item->id) }}"
                                    class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="fas fa-users fa-2x mb-2"></i><br>
                            Data anggota masih kosong
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('/js/plugin/datatables/datatables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(function() {
    $('.datatable').DataTable({
        responsive: true
    });
});

function confirmDelete(button) {
    let url = button.getAttribute('data-url');

    Swal.fire({
        title: 'Yakin hapus?',
        text: "Data anggota akan dihapus permanen!",
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

{{-- SUCCESS ALERT --}}
@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ session('success') }}',
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

@endpush