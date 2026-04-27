@extends('layouts.sbadmin')

@section('title', 'Detail Kategori')

@section('content')

<div class="pt-2 pb-3">
    <h3 class="fw-bold">Detail Kategori</h3>
    <small class="text-muted">Informasi lengkap kategori</small>
</div>

<div class="row">
    <div class="col-md-6">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="40%">Nama Kategori</th>
                        <td class="fw-semibold">
                            {{ $kategori->nama_kategori }}
                        </td>
                    </tr>

                    <tr>
                        <th>Dibuat</th>
                        <td>
                            {{ $kategori->created_at->format('d/m/Y H:i') }}
                        </td>
                    </tr>

                    <tr>
                        <th>Terakhir Update</th>
                        <td>
                            {{ $kategori->updated_at->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                </table>

                <hr>

                <div class="d-flex gap-2">

                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>

                 

                

                </div>

            </div>
        </div>

    </div>
</div>

@endsection