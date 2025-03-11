<x-app-layout>
    @extends('layouts.template')

    <style>
        /* Tambahkan gaya CSS untuk tabel dan komponen lainnya */
        .table th, .table td {
            padding: 12px; /* Padding untuk sel tabel */
            font-size: 14px; /* Ukuran font yang lebih kecil */
            vertical-align: middle; /* Posisi teks di tengah vertikal */
        }
        .table thead th {
            background-color: #f8f9fa; /* Warna background header */
            position: sticky;
            top: 0;
            z-index: 1;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05); /* Warna alternatif untuk baris ganjil */
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6; /* Border untuk sel tabel */
        }
    </style>

    <div class="container-fluid my-3 p-3 bg-body rounded shadow-sm">
        <!-- TITLE -->
        <h3 class="mb-5">GOVERNMENT SERVICE</h3>

        <div style="overflow-x: auto;"> <!-- Scroll horizontal jika tabel terlalu lebar -->
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">Name</th>
                        <th class="col-md-1">Datin</th>
                        <th class="col-md-1">Non-Datin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataGoverment as $manager)
                        <tr>
                            <td>{{ $manager['no'] }}</td>
                            <td>{{ $manager['name'] }}</td>
                            <td>{{ $manager['datin'] }}</td>
                            <td>{{ $manager['non_datin'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Navigasi -->
        <div class="d-flex mt-3">
            <!-- Tombol Back (Kiri) -->
            <button type="button" class="btn btn-outline-primary" onclick="window.location.href = '/account-manager'">Back</button>

            <!-- Tombol Navigasi (Kanan) -->
            <div class="ms-auto">
                <button type="button" class="btn btn-outline-secondary" onclick="window.location.href = '{{ route('business') }}'" title="Halaman Business">&lt;</button>
                <button type="button" class="btn btn-outline-secondary" onclick="window.location.href = '{{ route('enterprise') }}'" title="Halaman Enterprise">&gt;</button>
            </div>
        </div>
    </div>
</x-app-layout>
