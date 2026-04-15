@extends('layouts.app')

@section('title', 'Detail Anggota')

@section('content')
<div class="pt-2 pb-3">
    <h3 class="fw-bold">Detail Anggota</h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-body">
            <table class="table table-sm table-striped">
                <tr>
                    <th width="25%">Nama</th>
                    <td>{{ $anggota->nama }}</td>
                </tr>
                <tr>
                    <th>NIS</th>
                    <td>{{ $anggota->nis_nim }}</td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>{{ $anggota->kelas }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $anggota->alamat }}</td>
                </tr>
                <tr>
                    <th>No Telepon</th>
                    <td>{{ $anggota->no_telepon }}</td>
                </tr>
                <tr>
                    <th>Ditambahkan Pada</th>
                    <td>{{ \Carbon\Carbon::parse($anggota->created_at)->isoFormat('DD/MM/YY HH:mm') }}</td>
                </tr>
                <tr>
                    <th>Terakhir Diupdate</th>
                    <td>{{ \Carbon\Carbon::parse($anggota->updated_at)->isoFormat('DD/MM/YY HH:mm') }}</td>
                </tr>
            </table>

            <div class="d-flex gap-2">
                <a href="{{ route('anggota.index') }}" class="btn btn-primary">
                    Kembali
                </a>

                <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-outline-primary">
                    Edit
                </a>

                <button onclick="actionToDelete('{{ route('anggota.destroy', $anggota->id) }}')" 
                    class="btn btn-danger">
                    Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<form action="" method="POST" id="form-delete">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script src="{{ asset('/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<script>
function actionToDelete(url) {
    swal({
        title: "Apakah Anda yakin?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((confirm) => {
        if (confirm) {
            document.getElementById('form-delete').action = url;
            document.getElementById('form-delete').submit();
        }
    });
}
</script>
@endpush