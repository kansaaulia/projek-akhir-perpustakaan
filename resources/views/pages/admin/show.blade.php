@extends('layouts.sbadmin')

@section('title', 'Detail Admin')

@section('content')
    <div class="pt-2 pb-3">
        <h3 class="fw-bold">Detail Admin</h3>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <table class="table  table-sm table-striped">
                    <tr>
                        <th width="25%">Nama</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th width="25%">Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Ditambahkan Pada</th>
                        <td>{{ \Carbon\Carbon::parse($user->created_at)->isoFormat('DD/MM/YY HH:mm') }}</td>
                    </tr>
                    <tr>
                        <th >Terakhir diupdate</th>
                        <td>{{ \Carbon\Carbon::parse($user->updated_at)->isoFormat('DD/MM/YY HH:mm') }}</td>
                    </tr>
                </table>

                <div class="d-glex gap-2">
                    <a href="{{ route('admin.index') }}" class="btn btn-primary"><span class="fa fa-arrow-left">Kembali</span></a>
                    <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-outline-primary"><span class="fa fa-edit">Edit</span></a>
                    <a href="{{ route('admin.destroy', $user->id) }}" class="btn btn-danger" onclick="actionTo('{{ route('admin.destroy', $user->id) }}')Delete"><span class="fa fa-trash">Hapus</span></a>
                </div>
        </div>
    </div>

    <form action="" method="POST" id="form-delete">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script
src="{{ asset('/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<script type="text/javascript">
    function actionToDelete(url) {
        swal({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((confirm) => {
            if (confirm) {
                $('#form-delete').attr('action', url);
                $('#form-delete').submit();
            }
        });
    }
</script>
@endpush