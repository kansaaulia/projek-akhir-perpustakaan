@extends('layouts.app')

@section('title', 'Data Buku')

@section('content')

<div class="pt-2 pb-4">
    <h3 class="fw-bold mb-3">Data Buku</h3>
</div>

<a href="{{ route('buku.create') }}" class="btn btn-primary mb-3">
    <span class="fas fa-plus"></span> Tambah Buku
</a>

<div class="card card-body">
    <div class="table-responsive">
        <table class="table table-hover datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Buku</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($buku as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_buku }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->penulis }}</td>
                    <td>{{ $item->tahun_terbit }}</td>
                    <td>
                        @if ($item->stok > 0)
                            <span class="badge bg-success">Tersedia ({{ $item->stok }})</span>
                        @else
                            <span class="badge bg-danger">Habis</span>
                        @endif
                    </td>

                    <td>

                        <a href="{{ route('buku.show', $item->id) }}" 
                           class="btn text-info btn-link py-0 px-2 text-decoration-none">
                            <span class="fas fa-eye"></span> Detail
                        </a>

                        <a href="{{ route('buku.edit', $item->id) }}" 
                           class="btn text-primary btn-link py-0 px-2 text-decoration-none">
                            <span class="fas fa-edit"></span> Edit
                        </a>

                        <form action="{{ route('buku.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                onclick="return confirm('Yakin mau hapus?')" 
                                style="color:red; border:none; background:none;">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach

                @if($buku->isEmpty())
                <tr>
                    <td colspan="8" class="text-center">Data kosong</td>
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