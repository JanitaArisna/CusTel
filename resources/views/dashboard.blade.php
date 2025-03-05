<x-app-layout>
@extends('layouts.template')

@if (in_array(auth()->user()->role, ['admin', 'manager']))
    <div id="alert-box" class="alert alert-primary alert-dismissible fade show mx-auto mt-4" role="alert" style="max-width: 1000px;">
        <strong>Halo, {{ auth()->user()->name }}!</strong> You're logged in.
        <button type="button" class="btn-close" id="close-alert" aria-label="Close"></button>
    </div>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (sessionStorage.getItem("alertClosed")) {
            document.getElementById("alert-box").style.display = "none";
        }

        document.getElementById("close-alert").addEventListener("click", function () {
            document.getElementById("alert-box").style.display = "none";
            sessionStorage.setItem("alertClosed", "true");
        });
    });
</script>



    <div class="container mt-5">
        <div class="row">
            <!-- Card JUMLAH DATIN -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">PELANGGAN DATIN</div>
                    <div class="card-body">
                        <h2 class="card-title">{{ $jumlah_datin }}</h2>
                    </div>
                </div>
            </div>

            <!-- Card JUMLAH NON-DATIN -->
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">PELANGGAN NON-DATIN</div>
                    <div class="card-body">
                        <h2 class="card-title">{{ $jumlah_non_datin }}</h2>
                    </div>
                </div>
            </div>

            <!-- Card JUMLAH SELURUHNYA PELANGGAN -->
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">TOTAL PELANGGAN </div>
                    <div class="card-body">
                        <h2 class="card-title">{{ $total_jumlah }}</h2>
                    </div>
                </div>
            </div>


            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Datin', 'Non-Datin', 'Total'],
                datasets: [{
                    label: 'Total Estimasi Revenue',
                    data: [{{ $total_datin_bill }}, {{ $total_non_datin_bill }}, {{ $total_jumlah_bill }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',  // Biru untuk Datin
                        'rgba(75, 192, 192, 0.6)',  // Hijau untuk Non-Datin
                        'rgba(255, 99, 132, 0.6)'   // Merah untuk Total
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    });
</script>


</x-app-layout>



<!--
            <!-- Card JUMLAH BILL DATIN -->
            <!--<div class="col-md-4">
                <div class="card text-black bg-white mb-3" style="width: 300px; height: 250px;">
                    <div class="card-header">TOTAL ESTIMASI REVENUE DATIN</div>
                    <div class="card-body">
                        <h2 class="card-title">{{ $formatted_total_datin_bill }}</h2>
                    </div>
                </div>
            </div>
            <!-- Card JUMLAH BILL NON-DATIN -->
            <!--<div class="col-md-4">
                <div class="card text-black bg-white mb-3" style="width: 300px; height: 250px;">
                    <div class="card-header">TOTAL ESTIMASI REVENUE NON-DATIN</div>
                    <div class="card-body">
                        <h2 class="card-title">{{ $formatted_total_non_datin_bill }}</h2>
                    </div>
                </div>
            </div>
            <!-- Card JUMLAH SELURUHNYA BILL-->
            <!--<div class="col-md-4">
                <div class="card text-black bg-white mb-3" style="width: 300px; height: 250px;">
                    <div class="card-header">JUMLAH ESTIMASI REVENUE </div>
                    <div class="card-body">
                        <h2 class="card-title">{{ $formatted_total_jumlah_bill }}</h2>
                    </div>
                </div>
            </div>-->