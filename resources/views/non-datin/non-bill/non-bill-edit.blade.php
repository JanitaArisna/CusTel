@extends('layouts.template')

@section('konten')

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3 class="mb-4">EDIT BILL</h3>
    <form id="updateForm" action="{{ route('non-datin.bill.update', ['cca' => $cca, 'snd' => $snd, 'tahun' => $nonBill->tahun]) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Input SID -->
        <div class="mb-3">
            <label for="snd" class="form-label">SND</label>
            <input type="text" class="form-control" id="snd" name="snd" value="{{ $nonBill->snd }}" readonly>
        </div>

        <!-- Input Tahun -->
        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number" class="form-control" id="tahun" name="tahun" value="{{ old('tahun', $nonBill->tahun) }}" required>
        </div>

        <!-- Input Bulan (Januari - Desember) -->
        @foreach(['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'] as $bulan)
        <div class="mb-3">
            <label for="{{ $bulan }}" class="form-label">{{ ucfirst($bulan) }}</label>
            <input type="number" class="form-control" id="{{ $bulan }}" name="{{ $bulan }}" value="{{ old($bulan, $nonBill->$bulan) }}">
        </div>
        @endforeach

        <!-- Button Update and Cancel -->
        <button type="submit" class="btn btn-success" onclick="confirmUpdate()">Update</button>
        <a href="{{ url('non-datin') }}" class="btn btn-danger">Cancel</a>
    </form>
</div>

@include('komponen.pesan')

@endsection
