<x-app-layout>
    @extends('layouts.template')
    @include('komponen.pesan-datin')

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
document.addEventListener('DOMContentLoaded', function () {
    const mainFilter = document.getElementById('mainFilter');
    const bulanFilter = document.getElementById('bulanFilter');

    function toggleBulanFilter() {
        bulanFilter.style.display = mainFilter.value === 'bulan' ? 'inline-block' : 'none';
    }

    mainFilter.addEventListener('change', toggleBulanFilter);
    toggleBulanFilter(); // jalankan di awal untuk kondisi reload halaman
});

</script>


    <!-- START DATA -->
    <div class="container-fluid my-3 p-3 bg-body rounded shadow-sm">
        <!-- TITLE -->
        <h3 class="mb-4">REVENUE DATIN</h3>

        <!-- FORM PENCARIAN DAN FILTER -->
        <div class="pb-3 d-flex align-items-center">
            <form class="d-flex me-3" action="" method="get" id="searchForm">
                <input class="form-control me-2" type="search" name="katakunci"
                    value="{{ Request::get('katakunci') }}"
                    placeholder="Masukkan kata kunci" aria-label="Search" id="searchInput">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </form>
            <form method="GET" action="" class="d-flex me-3" id="filterForm">
                <select name="filter" id="mainFilter" class="select-filter me-2">
                    <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="bulan" {{ request('filter') == 'bulan' ? 'selected' : '' }}>Bulan</option>
                    <option value="pelanggan" {{ request('filter') == 'pelanggan' ? 'selected' : '' }}>Pelanggan Baru</option>
                </select>

                <select name="bulan" id="bulanFilter" class="select-filter me-2" style="display: none;">
                    <option value="">Pilih Bulan</option>
                    <option value="januari">Januari</option>
                    <option value="februari">Februari</option>
                    <option value="maret">Maret</option>
                    <option value="april">April</option>
                    <option value="mei">Mei</option>
                    <option value="juni">Juni</option>
                    <option value="juli">Juli</option>
                    <option value="agustus">Agustus</option>
                    <option value="september">September</option>
                    <option value="oktober">Oktober</option>
                    <option value="november">November</option>
                    <option value="desember">Desember</option>
                </select>

                <button class="btn btn-outline-dark me-3" type="submit">Filter</button>
            </form>


            @if(auth()->user()->role == 'admin')
                <a href='{{ route('datin.create') }}' class="btn btn-success">+ Tambah Data</a>
            @endif
        </div>

        <!-- TABEL -->
        <div style="overflow-x: auto;"> <!-- Scroll horizontal jika tabel terlalu lebar -->
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-2">Account Number</th>
                        <th class="col-md-2">Customer Name</th>
                        <th class="col-md-1">NIPNAS</th>
                        <th class="col-md-1">Segment</th>
                        <th class="col-md-1">Witels</th>
                        <th class="col-md-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">Data tidak ditemukan.</td>
                        </tr>
                    @else
                    <?php $i = $data->firstItem() ?>
                    <?php $lastAccNum = null; ?>
                    @foreach ($data as $item)
                        @if ($item->acc_num != $lastAccNum)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->acc_num }}</td>
                                <td>{{ $item->cust_nm }}</td>
                                <td>{{ $item->nipnas }}</td>
                                <td>{{ $item->segment_id }}</td>
                                <td>{{ $item->witel }}</td>
                                <td>
                                    <a href="{{ route('assets.show', $item->acc_num) }}" class="btn btn-outline-dark btn-sm">Asset</a>
                                    <a href="{{ route('bill.index', $item->acc_num) }}" class="btn btn-outline-dark btn-sm">Bill</a>
                                </td>
                            </tr>
                            <?php $lastAccNum = $item->acc_num; ?>
                            <?php $i++ ?>
                        @endif
                    @endforeach
                    @endif
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