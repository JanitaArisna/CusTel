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
        var months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        var datinValues = [
            {{ $total_datin_jan }}, {{ $total_datin_feb }}, {{ $total_datin_mar }},
            {{ $total_datin_apr }}, {{ $total_datin_mei }}, {{ $total_datin_jun }},
            {{ $total_datin_jul }}, {{ $total_datin_agu }}, {{ $total_datin_sep }},
            {{ $total_datin_okt }}, {{ $total_datin_nov }}, {{ $total_datin_des }}
        ];

        var nonDatinValues = [
            {{ $total_non_datin_jan }}, {{ $total_non_datin_feb }}, {{ $total_non_datin_mar }},
            {{ $total_non_datin_apr }}, {{ $total_non_datin_mei }}, {{ $total_non_datin_jun }},
            {{ $total_non_datin_jul }}, {{ $total_non_datin_agu }}, {{ $total_non_datin_sep }},
            {{ $total_non_datin_okt }}, {{ $total_non_datin_nov }}, {{ $total_non_datin_des }}
        ];

        // Array warna untuk setiap bar (bulan)
        var colors = [
            'rgba(255, 99, 132, 0.8)', // Merah
            'rgba(54, 162, 235, 0.8)', // Biru
            'rgba(75, 192, 192, 0.8)', // Hijau
            'rgba(255, 206, 86, 0.8)', // Kuning
            'rgba(153, 102, 255, 0.8)', // Ungu
            'rgba(255, 159, 64, 0.8)', // Oranye
            'rgba(199, 199, 199, 0.8)', // Abu-abu
            'rgba(83, 102, 255, 0.8)', // Biru Tua
            'rgba(40, 167, 69, 0.8)', // Hijau Tua
            'rgba(220, 53, 69, 0.8)', // Merah Tua
            'rgba(253, 126, 20, 0.8)', // Oranye Tua
            'rgba(111, 66, 193, 0.8)' // Ungu Tua
        ];

        var revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months, // Tampilkan semua bulan
                datasets: [
                    {
                        label: '', // Label kosong
                        data: months.map((month, i) => datinValues[i] + nonDatinValues[i]), // Hitung total untuk setiap bulan
                        backgroundColor: colors, // Warna untuk setiap bulan
                        borderColor: colors.map(color => color.replace('0.8', '1')), // Border warna untuk setiap bulan
                        borderWidth: 2,
                        borderRadius: 10
                    }
                ]
            },
            options: {
                responsive: true,
                animation: {
                    duration: 1000, // Animasi smooth
                    easing: 'easeInOutQuad'
                },
                plugins: {
                    legend: {
                        display: false // Sembunyikan legend (label dataset)
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#333',
                        bodyColor: '#000',
                        borderColor: '#ccc',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: false,
                        padding: 10,
                        callbacks: {
                            title: function(context) {
                                return months[context[0].dataIndex]; // Tampilkan nama bulan di tooltip
                            },
                            label: function(context) {
                                return 'Est Revenue: Rp ' + context.raw.toLocaleString('id-ID'); // Tampilkan total di tooltip
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            },
                            color: '#555'
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#555'
                        },
                        grid: {
                            display: false
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