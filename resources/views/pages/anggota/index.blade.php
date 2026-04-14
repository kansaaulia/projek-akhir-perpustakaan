@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')

<div class="pt-2 pb-4">
    <h3 class="fw-bold mb-3">Data Anggota</h3>
</div>

<a href="{{ route('anggota.create') }}" class="btn btn-primary mb-3">
    <span class="fas fa-plus"></span> Tambah Anggota
</a>

<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-hover datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>No Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($anggota as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nis_nim }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td>{{ $item->no_telp }}</td>
                    <td>

                        <a href="{{ route('anggota.show', $item->id) }}" 
                           class="btn text-info btn-link py-0 px-2 text-decoration-none">
                            <span class="fas fa-eye"></span> Detail
                        </a>

                        <a href="{{ route('anggota.edit', $item->id) }}" 
                           class="btn text-primary btn-link py-0 px-2 text-decoration-none">
                            <span class="fas fa-edit"></span> Edit
                        </a>

                        <a href="javascript:void(0);" 
                           class="btn text-danger btn-link py-0 px-2 text-decoration-none"
                           onclick="actionToDelete('{{ route('anggota.destroy', $item->id) }}')">
                            <span class="fas fa-trash"></span> Hapus
                        </a>

                    </td>
                </tr>
                @endforeach

                @if($anggota->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">Data kosong</td>
                </tr>
                @endif

            </tbody>
        </table>
    </div>
</div>

{{-- FORM DELETE --}}
<form method="POST" id="form-delete">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('scripts')
<script src="{{ asset('/js/plugin/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<script>
    $(function() {
        $('.datatable').DataTable();
    });

    function actionToDelete(url) {
        swal({
            title: "Yakin?",
            text: "Data akan dihapus permanen!",
            icon: "warning",
            buttons: ["Batal", "Hapus"],
            dangerMode: true,
        }).then((confirm) => {
            if (confirm) {
                $('#form-delete').attr('action', url);
                $('#form-delete').submit();
            }
        });
    }
</script>

@if(session('success'))
<script>
    swal({
        title: "Sukses",
        text: "{{ session('success') }}",
        icon: "success",
    });
</script>
@endif

@endpush