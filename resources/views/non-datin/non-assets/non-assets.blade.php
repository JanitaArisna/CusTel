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

    <script>
        // Fungsi untuk konfirmasi penghapusan
        function confirmDelete(sid) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                document.getElementById('delete-form-' + sid).submit();
            }
        }
    </script>

    <!-- START DATA -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- TITLE -->
        <h3 class="mb-1">ASSETS</h3>

        <!-- Tabel -->
        <div style="overflow-x: auto;"> <!-- Scroll horizontal jika tabel terlalu lebar -->
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="col-md-*">CCA</th>
                        <th class="col-md-*">SND</th>
                        <th class="col-md-*">SND-G</th>
                        <th class="col-md-*">NCLI</th>
                        <th class="col-md-*">Nama</th>
                        <th class="col-md-*">Address</th>
                        <th class="col-md-*">STO</th>
                        <th class="col-md-*">Segment</th>
                        <th class="col-md-*">Produk</th>
                        <th class="col-md-*">Desc NewBill</th>
                        <th class="col-md-*">Bundling</th>
                        <th class="col-md-*">Start</th>
                        <th class="col-md-*">End</th>
                        @if(auth()->user()->role == 'admin')
                            <th class="col-md-*">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $items)
                    <tr>
                        <td>{{ $items->cca }}</td>
                        <td>{{ $items->snd }}</td>
                        <td>{{ $items->snd_g }}</td>
                        <td>{{ $items->ncli }}</td>
                        <td>{{ $items->nama }}</td>
                        <td>{{ $items->alamat }}</td>
                        <td>{{ $items->sto }}</td>
                        <td>{{ $items->segment_non }}</td>
                        <td>{{ $items->produk }}</td>
                        <td>{{ $items->desc_newbill }}</td>
                        <td>{{ $items->bundling }}</td>
                        <td>{{ $items->start }}</td>
                        <td>{{ $items->end }}</td>

                        @if(auth()->user()->role == 'admin')
                            <td>
                                <a href="{{ route('non-datin.assets.edit', ['cca' => $items->cca, 'snd' => $items->snd]) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                                <form id="delete-form-{{ $items->snd }}" action="{{ route('non-datin.assets.destroy', ['cca' => $items->cca, 'snd' => $items->snd]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="Submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tombol Back -->
        <button type="button" class="btn btn-outline-primary mt-3" onclick="window.location.href = '/non-datin'">Back</button>
    </div>
    <!-- AKHIR DATA -->

    @include('komponen.pesan')
</x-app-layout>