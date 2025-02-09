@extends('layouts.template')

@section('konten')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Konten form untuk input data Bill -->
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3 class="mb-4">FORM BILL</h3>
    <form action="{{ route('bill.store', ['sid' => $sid]) }}" method="post">
        @csrf

        <!-- Input SID -->
        <div class="mb-3">
            <label for="sid" class="form-label">SID</label>
            <input type="text" class="form-control" id="sid" name="sid" value="{{ $sid }}" readonly>
        </div>

        <!-- Input Bulan (Januari - Desember) -->
        @foreach(['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'] as $bulan)
        <div class="mb-3">
            <label for="{{ $bulan }}" class="form-label">{{ ucfirst($bulan) }}</label>
            <input type="number" class="form-control" id="{{ $bulan }}" name="{{ $bulan }}" required>
        </div>
        @endforeach

        <!-- Input Tahun -->
        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number" class="form-control" id="tahun" name="tahun" required>
        </div>

        <!-- Button Save and Cancel -->
        <button type="submit" class="btn btn-success">Save</button>
        <a href='{{ url('datin') }}' class="btn btn-danger">Cancel</a>
    </form>
</div>

@endsection
