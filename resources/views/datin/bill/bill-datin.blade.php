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

    <!-- START DATA -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- TITLE -->
        <h3 class="mb-1">TAMPILAN BILL</h3>
        <h2 class="text-xs text-gray-400 mb-4">SID: {{ $sid }}</h2>

        <a href="{{ route('bill.create', $sid) }}" class="btn btn-success">+ Tambah Bill</a>

        <div style="overflow-x: auto;">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="col-md-*">SID</th>
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
                        <th class="col-md-*">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->sid }}</td>
                        <td>@rupiah($item->januari)</td>
                        <td>@rupiah($item->februari)</td>
                        <td>@rupiah($item->maret)</td>
                        <td>@rupiah($item->april)</td>
                        <td>@rupiah($item->mei)</td>
                        <td>@rupiah($item->juni)</td>
                        <td>@rupiah($item->juli)</td>
                        <td>@rupiah($item->agustus)</td>
                        <td>@rupiah($item->september)</td>
                        <td>@rupiah($item->oktober)</td>
                        <td>@rupiah($item->november)</td>
                        <td>@rupiah($item->desember)</td>
                        <td>{{ $item->tahun }}</td>
                        <td>
                            @php
                                $bill = $data->first();
                            @endphp
                            <a href="{{ route('bill.edit', ['sid' => $bill->sid, 'tahun' => $bill->tahun]) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                            <form action="{{ route('bill.destroy', ['sid' => $bill->sid, 'tahun' => $bill->tahun]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-outline-primary mt-3" onclick="window.history.back()">Back</button>
    </div>
    <!-- AKHIR DATA -->
</x-app-layout>