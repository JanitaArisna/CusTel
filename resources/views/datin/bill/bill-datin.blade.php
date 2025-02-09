<x-app-layout>
@extends('layouts.template')

@section('konten')
    <!-- START DATA -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- TITLE -->
        <h3 class="mb-4">BILL</h3>
        <a href="{{ route('bill.create', $sid) }}" class="btn btn-success">+ Tambah Bill</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">SID</th>
                    <th class="col-md-1">Jan</th>
                    <th class="col-md-1">Feb</th>
                    <th class="col-md-1">Mar</th>
                    <th class="col-md-1">Apr</th>
                    <th class="col-md-1">Mei</th>
                    <th class="col-md-1">Juni</th>
                    <th class="col-md-1">Juli</th>
                    <th class="col-md-1">Agt</th>
                    <th class="col-md-1">Sep</th>
                    <th class="col-md-1">Okt</th>
                    <th class="col-md-1">Nov</th>
                    <th class="col-md-1">Des</th>
                    <th class="col-md-1">Tahun</th>
                    <th class="col-md-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->sid }}</td>
                    <td>{{ $item->januari }}</td>
                    <td>{{ $item->februari }}</td>
                    <td>{{ $item->maret }}</td>
                    <td>{{ $item->april }}</td>
                    <td>{{ $item->mei }}</td>
                    <td>{{ $item->juni }}</td>
                    <td>{{ $item->juli }}</td>
                    <td>{{ $item->agustus }}</td>
                    <td>{{ $item->september }}</td>
                    <td>{{ $item->oktober }}</td>
                    <td>{{ $item->november }}</td>
                    <td>{{ $item->desember }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>
                        <a href="" class="btn btn-outline-warning btn-sm">Edit</a>
                        <a href="" class="btn btn-outline-danger btn-sm">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" onclick="window.history.back()">back</button>
    </div>
    <!-- AKHIR DATA -->
@endsection
</x-app-layout>
