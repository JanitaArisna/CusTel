<x-app-layout>
    @extends('layouts.template')

    <style>
        /* Tambahkan gaya CSS untuk tabel */
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
        .btn-sm {
            margin: 2px; /* Margin untuk tombol kecil */
        }
    </style>

    <!-- START DATA -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- TITLE -->
        <h3 class="mb-1">BILL</h3>
        @php
            $firstItem = $data->first();
        @endphp

        @if ($firstItem)
            <h2 class="text-xs text-gray-400 mb-4">Account Number: {{ $firstItem->acc_num }}</h2>
        @endif

        <!-- Tabel -->
        <div style="overflow-x: auto;"> <!-- Scroll horizontal jika tabel terlalu lebar -->
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="col-md-2">Acc Num</th>
                        <th class="col-md-2">Cus Name</th>
                        <th class="col-md-1">SID</th>
                        <th class="col-md-1">Kontrak</th>
                        <th class="col-md-1">Start</th>
                        <th class="col-md-1">End</th>
                        <th class="col-md-2">Account Manager</th>
                        @if(auth()->user()->role == 'admin')
                            <th class="col-md-2">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->acc_num }}</td>
                        <td>{{ $item->cust_nm }}</td>
                        <td>{{ $item->sid }}</td>
                        <td>{{ $item->kontrak }}</td>
                        <td>{{ $item->start }}</td>
                        <td>{{ $item->end }}</td>
                        <td>{{ $item->am_nm }}</td>
                        @if(auth()->user()->role == 'admin')
                            <td>
                                <a href="{{ route('bill.show', ['sid' => $item->sid]) }}" class="btn btn-outline-info btn-sm">Show Bill</a>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tombol Back -->
        <button type="button" class="btn btn-outline-primary mt-3" onclick="window.location.href = '/datin'">Back</button>
    </div>
    <!-- AKHIR DATA -->

    @include('komponen.pesan')
</x-app-layout>