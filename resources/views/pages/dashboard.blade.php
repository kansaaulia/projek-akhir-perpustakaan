@extends('layouts.sbadmin')

@section('title', 'Dashboard')

@section('content')

<h1>Dashboard</h1>

<div class="row">
    <div class="col-md-6">
        <canvas id="myAreaChart"></canvas>
    </div>

    <div class="col-md-6">
        <canvas id="myBarChart"></canvas>
    </div>
</div>

@endsection


@push('scripts')
<script>
    const labels = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"];

    const peminjamanData = @json($peminjamanChart ?? []);
    const pengembalianData = @json($pengembalianChart ?? []);

    new Chart(document.getElementById("myAreaChart"), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Peminjaman',
                data: peminjamanData
            }]
        }
    });

    new Chart(document.getElementById("myBarChart"), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pengembalian',
                data: pengembalianData
            }]
        }
    });
</script>
@endpush