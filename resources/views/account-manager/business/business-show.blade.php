<x-app-layout>
    @extends('layouts.template')

    <style>
        /* Tambahkan gaya CSS untuk tabel */
        .table th, .table td {
            padding: 12px;
            font-size: 14px;
            vertical-align: middle;
        }
        .table thead th {
            background-color: #f8f9fa;
            position: sticky;
            top: 0;
            z-index: 1;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }
        .table-container {
            margin-bottom: 20px;
        }
    </style>

    <div class="container-fluid my-3 p-3 bg-body rounded shadow-sm">
        <!-- Title -->
        <h3 class="mb-2">BUSINESS SERVICE DETAILS</h3>
        <h2 class="text-xs text-gray-400 mb-4">Manager: {{ $dataBusiness }}</h5>

        <!-- Tabel Datin -->
        <div class="table-container" style="overflow-x: auto;">
            <h4>Datin</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-1">Account Number</th>
                        <th class="col-md-1">Customer Name</th>
                        <th class="col-md-1">SID</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datinData as $index => $datin)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $datin->acc_num }}</td>
                            <td>{{ $datin->cust_nm }}</td>
                            <td>{{ $datin->sid }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada data Datin</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <hr style="border: 1px solid #ccc; margin: 30px 0;"> <!-- Garis Pemisah -->
        <!-- Tabel Nondatin -->
        <div class="table-container" style="overflow-x: auto;">
            <h4>Non-Datin</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-1">CCA</th>
                        <th class="col-md-1">Nama</th>
                        <th class="col-md-1">SND</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($nondatinData as $index => $nondatin)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $nondatin->cca }}</td>
                            <td>{{ $nondatin->nama }}</td>
                            <td>{{ $nondatin->snd }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada data Non-Datin</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Tombol Back -->
        <button type="button" class="btn btn-outline-primary mt-3" onclick="window.location.href = '{{ route('business') }}'">
            Back
        </button>
    </div>
</x-app-layout>
