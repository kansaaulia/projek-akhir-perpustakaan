@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')

<div class="pt-2 pb-4">
    <h3 class="fw-bold mb-3">Data Kategori</h3>
</div>

<a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">
    Tambah Kategori
</a>

<div class="card card-body">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($kategori as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_kategori }}</td>
                <td>
                    <a href="{{ route('kategori.show', $item->id) }}">Detail</a> |
                    <a href="{{ route('kategori.edit', $item->id) }}">Edit</a> |

                    <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach

            @if($kategori->isEmpty())
            <tr>
                <td colspan="3" class="text-center">Data kosong</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

@endsection