@extends('layouts.template')

@section('konten')

<!-- Menampilkan pesan error jika ada -->
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

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
    <form action="{{ route('bill.store', ['sid' => $sid]) }}" method="POST">
        @csrf

        <!-- Input SID -->
        <div class="mb-3">
            <label for="sid" class="form-label">SID</label>
            <input type="text" class="form-control" id="sid" name="sid" value="{{ $sid }}" readonly>
        </div>

        <!-- Input Tahun -->
        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number" class="form-control" id="tahun" name="tahun" value="{{ old('tahun') }}" required>
        </div>

        <!-- Input Bulan (Januari - Desember) -->
        @foreach(['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'] as $bulan)
        <div class="mb-3">
            <label for="{{ $bulan }}" class="form-label">{{ ucfirst($bulan) }}</label>
            <input type="number" class="form-control" id="{{ $bulan }}" name="{{ $bulan }}" value="{{ old($bulan) }}">
        </div>
        @endforeach

        <!-- Button Save and Cancel -->
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('bill.show', ['sid' => $sid]) }}"class="btn btn-danger">Cancel</a>
    </form>
</div>

@endsection
