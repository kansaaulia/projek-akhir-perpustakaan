@extends('layouts.sbadmin')

@section('title', 'Data Admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Data Admin</h3>
        <small class="text-muted">Manajemen user sistem</small>
    </div>

    <a href="{{ route('admin.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus me-2"></i> Tambah Admin
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
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-center" width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $item)
                    <tr>
                        <td class="fw-semibold">{{ $loop->iteration }}</td>

                        <td class="fw-semibold">
                            {{ $item->name }}
                        </td>

                        <td class="text-muted small">
                            {{ $item->email }}
                        </td>

                        <td>
                            @if($item->role == 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @elseif($item->role == 'petugas')
                                <span class="badge bg-warning text-dark">Petugas</span>
                            @else
                                <span class="badge bg-secondary">Anggota</span>
                            @endif
                        </td>

                        <td class="text-center">

                            <!-- DETAIL -->
                            <a href="{{ route('admin.show', $item->id) }}"
                               class="btn btn-sm btn-info text-white me-1">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- EDIT -->
                            <a href="{{ route('admin.edit', $item->id) }}"
                               class="btn btn-sm btn-warning text-white me-1">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- DELETE -->
                            @if($item->id != auth()->id())
                                <button type="button"
                                        onclick="confirmDelete(this)"
                                        data-url="{{ route('admin.destroy', $item->id) }}"
                                        class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @else
                                <span class="badge bg-light text-dark">Akun Anda</span>
                            @endif

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <i class="fas fa-user-slash fa-2x mb-2"></i><br>
                            Data admin belum tersedia
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
        text: "User akan dihapus permanen!",
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