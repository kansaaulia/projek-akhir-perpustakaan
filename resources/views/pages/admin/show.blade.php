@extends('layouts.sbadmin')

@section('title', 'Detail Admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Detail Admin</h3>
        <small class="text-muted">Informasi lengkap user</small>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <table class="table table-sm align-middle">
            <tr>
                <th width="25%">Nama</th>
                <td class="fw-semibold">{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td class="text-muted">{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>
                    @if($user->role == 'admin')
                        <span class="badge bg-danger">Admin</span>
                    @elseif($user->role == 'petugas')
                        <span class="badge bg-warning text-dark">Petugas</span>
                    @else
                        <span class="badge bg-secondary">Anggota</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Ditambahkan</th>
                <td>{{ \Carbon\Carbon::parse($user->created_at)->isoFormat('DD/MM/YY HH:mm') }}</td>
            </tr>
            <tr>
                <th>Terakhir Update</th>
                <td>{{ \Carbon\Carbon::parse($user->updated_at)->isoFormat('DD/MM/YY HH:mm') }}</td>
            </tr>
        </table>

        <div class="d-flex gap-2 mt-3">

            <!-- KEMBALI -->
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>

            
          
        </div>

    </div>
</div>

@endsection