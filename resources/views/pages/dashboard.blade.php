@extends('layouts.sbadmin')

@section('title', 'Dashboard')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold mb-0">Dashboard</h3>
    <small class="text-muted">Ringkasan aktivitas perpustakaan</small>
</div>

{{-- STAT CARDS --}}
<div class="row mb-4">

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="text-muted small">Total Buku</div>
                <h4 class="fw-bold">{{ $totalBuku ?? 0 }}</h4>
                <i class="fas fa-book text-primary"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="text-muted small">Total Anggota</div>
                <h4 class="fw-bold">{{ $totalAnggota ?? 0 }}</h4>
                <i class="fas fa-users text-success"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="text-muted small">Peminjaman</div>
                <h4 class="fw-bold">{{ $totalPeminjaman ?? 0 }}</h4>
                <i class="fas fa-arrow-up text-warning"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="text-muted small">Pengembalian</div>
                <h4 class="fw-bold">{{ $totalPengembalian ?? 0 }}</h4>
                <i class="fas fa-arrow-down text-danger"></i>
            </div>
        </div>
    </div>

</div>

{{-- CHART --}}
<div class="row">

    {{-- AREA CHART --}}
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-semibold">
                Grafik Peminjaman
            </div>
            <div class="card-body">
                <canvas id="myAreaChart"></canvas>
            </div>
        </div>
    </div>

    {{-- BAR CHART --}}
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-semibold">
                Grafik Pengembalian
            </div>
            <div class="card-body">
                <canvas id="myBarChart"></canvas>
            </div>
        </div>
    </div>

</div>

@endsection
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const labels = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"];

const peminjamanData = @json($peminjamanChart ?? []);
const pengembalianData = @json($pengembalianChart ?? []);

// AREA CHART
new Chart(document.getElementById("myAreaChart"), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Peminjaman',
            data: peminjamanData,
            fill: true,
            tension: 0.4,
            borderWidth: 2
        }]
    },
    options: {
        plugins: {
            legend: { display: false }
        }
    }
});

// BAR CHART
new Chart(document.getElementById("myBarChart"), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Pengembalian',
            data: pengembalianData,
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
            legend: { display: false }
        }
    }
});
</script>

@endpush