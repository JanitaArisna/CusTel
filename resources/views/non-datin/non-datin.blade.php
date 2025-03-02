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
        .btn-sm {
            margin: 2px; /* Margin untuk tombol kecil */
        }
        .form-control {
            width: 200px; /* Lebar input pencarian */
        }
        .select-filter {
            width: 150px; /* Lebar dropdown filter */
            padding: 6px;
            border-radius: 4px;
            border: 1px solid #ced4da;
        }
    </style>

    <script>
        // Fungsi untuk menangani filter
        function applyFilter() {
            const filterValue = document.querySelector('.select-filter').value;
            alert('Filter diterapkan: ' + filterValue); // Ganti dengan logika filter yang sesuai
        }
    </script>

        <div class="container-fluid my-3 p-3 bg-body rounded shadow-sm">
        <!-- TITLE -->
        <h3 class="mb-4">REVENUE NON DATIN</h3>

        <!-- FORM PENCARIAN DAN FILTER -->
        <div class="pb-3 d-flex align-items-center">
            <form class="d-flex me-3" action="" method="get">
                <input class="form-control me-2" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </form>
            
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('non-datin.create') }}" class="btn btn-success">+ Tambah Data</a>
            @endif
        </div>


        <!-- TABEL -->
        <div style="overflow-x: auto;"> <!-- Scroll horizontal jika tabel terlalu lebar -->
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-1">SND</th>
                        <th class="col-md-1">Nama</th>
                        <th class="col-md-2">CCA</th>
                        <th class="col-md-2">NCLI</th>
                        <th class="col-md-1">STO</th>
                        <th class="col-md-1">Segment</th>
                        <th class="col-md-1">Desc NewBill</th>
                        <th class="col-md-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $data->firstItem() ?>
                    <?php $lastCCA = null; ?>
                    @foreach($data as $items)
                        @if ($items->cca != $lastCCA)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $items->snd }}</td>
                                <td>{{ $items->nama }}</td>
                                <td>{{ $items->cca }}</td>
                                <td>{{ $items->ncli }}</td>
                                <td>{{ $items->sto }}</td>
                                <td>{{ $items->segment_non }}</td>
                                <td>{{ $items->desc_newbill }}</td>
                                <td>
                                    <a href="{{ route('non-datin.assets.index', $items->cca) }}" class="btn btn-outline-dark btn-sm">Assets</a>
                                    <a href="{{ route('non-datin.bill.index', $items->cca) }}" class="btn btn-outline-dark btn-sm">Bill</a>
                                </td>
                            <?php $lastCCA = $items->cca; ?>
                            <?php $i++ ?>
                            </tr>
                         @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="mt-3">
            {{ $data->withQueryString()->links() }}
        </div>
    </div>
    <!-- AKHIR DATA -->
</x-app-layout>
