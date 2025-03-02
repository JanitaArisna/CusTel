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

            <!-- Card JUMLAH SELURUHNYA -->
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">TOTAL PELANGGAN </div>
                    <div class="card-body">
                        <h2 class="card-title">{{ $total_jumlah }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>