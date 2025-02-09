@extends('layouts.template')

@section('konten')

    <!-- Konten form untuk tambah data -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="mb-4">INPUT DATA PELANGGAN BARU</h3>
        <form action='{{ url ('datin') }}' method='post'>
            @csrf
            <div class="mb-3">
                <label for="acc_num" class="form-label">Account Number</label>
                <input type="text" class="form-control" id="acc_num" value="{{ Session::get('acc_num') }}" name="acc_num" required>
            </div>
            <div class="mb-3">
                <label for="cust_name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="cust_nm" value="{{ Session::get('cust_nm') }}" name="cust_nm" required>
            </div>
            <div class="mb-3">
                <label for="nipnas" class="form-label">NIPNAS</label>
                <input type="text" class="form-control" id="nipnas" value="{{ Session::get('nipnas') }}" name="nipnas" required>
            </div>
            <div class="mb-3">
                <label for="segment" class="form-label">Segment</label>
                <select class="form-select" aria-label="Default select example" id="segment_id" name="segment_id" required>
                    <option disabled {{ is_null(Session::get('segment_id')) ? 'selected' : '' }}>Pilih Segment</option>
                    <option value="DPS-LMS" {{ Session::get('segment_id') == 'DPS-LMS' ? 'selected' : '' }}>DPS-LMS</option>
                    <option value="DPS-FWS" {{ Session::get('segment_id') == 'DPS-FWS' ? 'selected' : '' }}>DPS-FWS</option>
                    <option value="DPS-PCS" {{ Session::get('segment_id') == 'DPS-PCS' ? 'selected' : '' }}>DPS-PCS</option>
                    <option value="DPS-PRS" {{ Session::get('segment_id') == 'DPS-PRS' ? 'selected' : '' }}>DPS-PRS</option>
                    <option value="DPS-RMS" {{ Session::get('segment_id') == 'DPS-RMS' ? 'selected' : '' }}>DPS-RMS</option>
                    <option value="DSS-ERS" {{ Session::get('segment_id') == 'DSS-ERS' ? 'selected' : '' }}>DSS-ERS</option>
                    <option value="DSS-MIS" {{ Session::get('segment_id') == 'DSS-MIS' ? 'selected' : '' }}>DSS-MIS</option>
                    <option value="RBS-R01" {{ Session::get('segment_id') == 'RBS-R01' ? 'selected' : '' }}>RBS-R01</option>
                    <option value="REG-R01" {{ Session::get('segment_id') == 'REG-R01' ? 'selected' : '' }}>REG-R01</option>
                    <option value="DGS-BTR" {{ Session::get('segment_id') == 'DGS-BTR' ? 'selected' : '' }}>DGS-BTR</option>
                    <option value="DGS-R01" {{ Session::get('segment_id') == 'DGS-R01' ? 'selected' : '' }}>DGS-R01</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="witel" class="form-label">Witel</label>
                <input type="text" class="form-control" id="witel" value="{{ Session::get('witel') }}" name="witel" required>
            </div>

            <!-- Additional Fields -->
            <div class="mb-3">
                <label for="sid" class="form-label">SID</label>
                <input type="text" class="form-control" id="sid" value="{{ Session::get('sid') }}" name="sid" required>
            </div>
            <div class="mb-3">
                <label for="layanan" class="form-label">Layanan</label>
                <select class="form-select" id="layanan_id" name="layanan_id" required>
                    <option disabled {{ is_null(Session::get('layanan_id')) ? 'selected' : '' }}>Pilih Layanan</option>
                    <option value="High Speed Internet" {{ Session::get('layanan_id') == 'High Speed Internet' ? 'selected' : '' }}>High Speed Internet</option>
                    <option value="Wifi Managed Service" {{ Session::get('layanan_id') == 'Wifi Managed Service' ? 'selected' : '' }}>Wifi Managed Service</option>
                    <option value="Wireline" {{ Session::get('layanan_id') == 'Wireline' ? 'selected' : '' }}>Wireline</option>
                    <option value="Indibiz" {{ Session::get('layanan_id') == 'Indibiz' ? 'selected' : '' }}>Indibiz</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="bandwidth" class="form-label">Bandwidth</label>
                <input type="text" class="form-control" id="bw" value="{{ Session::get('bw') }}" name="bw" required>
            </div>
            <div class="mb-3">
                <label for="kontrak" class="form-label">Kontrak</label>
                <input type="text" class="form-control" id="kontrak" value="{{ Session::get('kontrak') }}" name="kontrak" required>
            </div>
            <div class="mb-3">
                <label for="start_kontrak" class="form-label">Start Kontrak</label>
                <input type="date" class="form-control" id="start" value="{{ Session::get('start') }}" name="start" required>
            </div>
            <div class="mb-3">
                <label for="end_kontrak" class="form-label">End Kontrak</label>
                <input type="date" class="form-control" id="end" value="{{ Session::get('end') }}" name="end" required>
            </div>
            <div class="mb-3">
                <label for="account_manager" class="form-label">Account Manager</label>
                <select class="form-select" id="am_nm" name="am_nm" required>
                    <option disabled {{ is_null(Session::get('am_nm')) ? 'selected' : '' }}>Pilih Account Manager</option>
                    <option value="Windi" {{ Session::get('am_nm') == 'Windi' ? 'selected' : '' }}>Windi</option>
                    <option value="Kafi" {{ Session::get('am_nm') == 'Kafi' ? 'selected' : '' }}>Kafi</option>
                    <option value="Nadin" {{ Session::get('am_nm') == 'Nadin' ? 'selected' : '' }}>Nadin</option>
                    <option value="Fitri" {{ Session::get('am_nm') == 'Fitri' ? 'selected' : '' }}>Fitri</option>
                </select>
            </div>

            <!-- Button Save and Cancel -->
            <button type="submit" class="btn btn-success">Save</button>
            <a href='{{ url('datin') }}' class="btn btn-danger">Cancel</a>

        </form>
    </div>
@endsection
