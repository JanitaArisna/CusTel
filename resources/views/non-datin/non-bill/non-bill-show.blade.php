<x-app-layout>
    @extends('layouts.template')

    <style>
        .table th, .table td {
            padding: 12px;
            font-size: 14px;
        }
        .table thead th {
            position: sticky;
            top: 0;
            background-color: #f8f9fa;
            z-index: 1;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }
    </style>
    <script>
        // Fungsi untuk konfirmasi penghapusan
        function confirmDelete(sid) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                document.getElementById('delete-form-' + snd).submit();
            }
        }
    </script>

    <!-- START DATA -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- TITLE -->
        <h3 class="mb-1">TAMPILAN BILL</h3>
        <h2 class="text-xs text-gray-400 mb-1">Halaman ini berisi data Tagihan Non Datin</h2>
        <h2 class="text-xs text-gray-400 mb-3">CCA: {{ $cca }}  /  SND: {{$snd}}</h2>
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('non-datin.bill.create', ['cca' => $cca, 'snd' => $snd]) }}" class="btn btn-success">+ Tambah Bill</a><br><br>
        @endif
    
        <div style="overflow-x: auto;">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="col-md-*">SND</th>
                        <th class="col-md-*">Jan</th>
                        <th class="col-md-*">Feb</th>
                        <th class="col-md-*">Mar</th>
                        <th class="col-md-*">Apr</th>
                        <th class="col-md-*">Mei</th>
                        <th class="col-md-*">Juni</th>
                        <th class="col-md-*">Juli</th>
                        <th class="col-md-*">Agt</th>
                        <th class="col-md-*">Sep</th>
                        <th class="col-md-*">Okt</th>
                        <th class="col-md-*">Nov</th>
                        <th class="col-md-*">Des</th>
                        <th class="col-md-*">Tahun</th>
                        @if(auth()->user()->role == 'admin')
                            <th class="col-md-*">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $nonBill)
                    <tr>
                        <td>{{ $nonBill->snd }}</td>
                        <td>{{$nonBill->januari}}</td>
                        <td>{{$nonBill->februari}}</td>
                        <td>{{$nonBill->maret}}</td>
                        <td>{{$nonBill->april}}</td>
                        <td>{{$nonBill->mei}}</td>
                        <td>{{$nonBill->juni}}</td>
                        <td>{{$nonBill->juli}}</td>
                        <td>{{$nonBill->agustus}}</td>
                        <td>{{$nonBill->september}}</td>
                        <td>{{$nonBill->oktober}}</td>
                        <td>{{$nonBill->november}}</td>
                        <td>{{$nonBill->desember}}</td>
                        <td>{{$nonBill->tahun}}</td>
                        @if(auth()->user()->role == 'admin')
                            <td>
                                <a href="{{ route('non-datin.bill.edit', ['cca' => $cca, 'snd' => $snd, 'tahun' => $nonBill->tahun]) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                                <form id="delete-form-{{ $nonBill->snd }}" action="{{ route('non-datin.bill.destroy', ['cca' => $cca, 'snd' => $snd, 'tahun' => $nonBill->tahun]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="Button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete('{{ $nonBill->snd }}')">Delete</button>
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
    <!-- END DATA -->
</x-app-layout>