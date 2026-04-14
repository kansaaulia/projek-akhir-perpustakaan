@extends('layouts.app')

@section('title', 'Data Admin')
    

@section('content')
    <div class="pt-2 pb-4">
        <h3 class="fw-bold mb-3">Data Admin</h3>
    </div>

    <a href="{{ route('admin.create') }}" class="btn btn-primary mb-3"><span class="fas fa-plus"></span> Tambah Baru</a>
    
    <div class="card card-body">
        <div class="table-responsive">
            <table class=" table table-hover datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Admin</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    {{-- @if($item->id == 1)
                                        <span class="text-muted">Tidak dapat diubah</span>
                                    @else --}}
                                
                                        <a href="{{ route('admin.edit', $item->id) }}" class="btn text-primary btn-link py-0 px-2 text-decoration-none"><span class="fas fa-edit"></span> Edit</a>
                                        <a href="{{ route('admin.show', $item->id) }}" class="btn text-info btn-link py-0 px-2 text-decoration-none "><span class="fas fa-eye"></span> Detail</a>
                                      <form action="{{ route('admin.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin mau hapus?')" style="color:red; border:none; background:none;">
                                                Hapus
                                            </button>
                                        </form>
                                    {{-- @endif --}}
                                </td>
                            </tr>
                        @endforeach
                        @stack('scripts')
                    </tbody>
            </table>
        </div>
    </div>

    <form action="" method="post" id="form-delete">
        @csrf
        @method('delete')
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('.datatable').DataTable();
        });

        function actionToDelete(url) {
            swal({
                title: "Apakah Anda yakin?",
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ["Batal", "Ya, Hapus!"]
            })
            .then((confirm) => {
                if (confirm) {
                    $('#form-delete').attr('action', url);
                    $('#form-delete').submit();
                }
            });
        }
    </script>

     @if (session('success'))
            <script>
                swal({
                    title: "success",
                    text: "{{ session('success') }}",
                    icon: "success",
                });
            </script>

        @endif
@endpush