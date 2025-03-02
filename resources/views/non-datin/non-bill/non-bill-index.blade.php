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

    <div>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <h3 class="mb-1">BILL</h3>
            @php
                $firstItem = $data->first();
            @endphp

            @if ($firstItem)
            <h1 class="text-xs text-gray-400 mb-1">Non-Datin</h1>
            <h2 class="text-xs text-gray-400 mb-4">CCA : {{ $firstItem->cca }}</h2>
            @endif

            <!-- Tabel -->
            <div style="overflow-x: auto;"> <!-- Scroll horizontal jika tabel terlalu lebar -->
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="col-md-*">CCA</th>
                            <th class="col-md-*">Nama</th>
                            <th class="col-md-*">SND</th>
                            <th class="col-md-*">SND Group</th>
                            <th class="col-md-*">STO</th>
                            <th class="col-md-*">Start</th>
                            <th class="col-md-*">End</th>
                            <th class="col-md-*">Account Manager</th>
                            <th class="col-md-*">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $items)
                        <tr>
                            <td>{{ $items->cca }}</td>
                            <td>{{ $items->nama }}</td>
                            <td>{{ $items->snd }}</td>
                            <td>{{ $items->snd_g }}</td>
                            <td>{{ $items->sto }}</td>
                            <td>{{ $items->start }}</td>
                            <td>{{ $items->end }}</td>
                            <td>{{ $items->manager }}</td>
                            <td>
                                <a href="{{ route('non-datin.bill.show', ['cca' => $items->cca, 'snd' => $items->snd]) }}" class="btn btn-outline-info btn-sm">Show Bill</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="button" class="btn btn-outline-primary mt-3" onclick="window.location.href = '/non-datin'">Back</button>
        </div>
    </div>
    <!-- AKHIR DATA -->

    @include('komponen.pesan')
</x-app-layout>