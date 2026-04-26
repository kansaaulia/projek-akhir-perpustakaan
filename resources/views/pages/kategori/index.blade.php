@extends('layouts.sbadmin')

@section('title', 'Data Kategori')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Data Kategori</h3>
        <small class="text-muted">Manajemen kategori buku</small>
    </div>

    <a href="{{ route('kategori.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus me-2"></i> Tambah Kategori
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Kategori</th>
                        <th class="text-center" width="200">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($kategori as $item)
                    <tr>
                        <td class="fw-semibold">{{ $loop->iteration }}</td>

                        <td>
                            <i class="fas fa-tag text-primary me-2"></i>
                            {{ $item->nama_kategori }}
                        </td>

                        <td class="text-center">

                            <!-- DETAIL -->
                            <a href="{{ route('kategori.show', $item->id) }}"
                               class="btn btn-sm btn-info text-white me-1">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- EDIT -->
                            <a href="{{ route('kategori.edit', $item->id) }}"
                               class="btn btn-sm btn-warning text-white me-1">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('kategori.destroy', $item->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin mau hapus kategori ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">
                            <i class="fas fa-folder-open fa-2x mb-2"></i><br>
                            Data kategori masih kosong
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection