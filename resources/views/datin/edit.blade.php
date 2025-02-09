@extends('layouts.template')

@section('konten')

    <!-- Konten form untuk tambah data -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="mb-1">UPDATE DATA PELANGGA</h3>
        @if(isset($data) && $data->sid)
            <p class="text-xs text-gray-400 mb-4">SID Pelanggan: {{ $data->sid }}</h2>
        @endif
        <form id="updateForm" action='{{ url ('datin/'.$data->sid) }}' method='post'>
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="acc_num" class="form-label">Account Number</label>
                <input type="text" class="form-control" id="acc_num" value="{{ $data->acc_num }}" name="acc_num" required>
            </div>
            <div class="mb-3">
                <label for="cust_name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="cust_nm" value="{{ $data->cust_nm }}" name="cust_nm" required>
            </div>
            <div class="mb-3">
                <label for="nipnas" class="form-label">NIPNAS</label>
                <input type="text" class="form-control" id="nipnas" value="{{ $data->nipnas }}" name="nipnas" required>
            </div>
            <div class="mb-3">
                <label for="segment" class="form-label">Segment</label>
                <select class="form-select" aria-label="Default select example" id="segment_id" value="{{ $data->segment_id }}" name="segment_id" required>
                    <option selected>Pilih Segment</option>
                    <option value="DPS-FWS" {{ old('segment_id', $data->segment_id) == 'DPS-FWS' ? 'selected' : '' }}>DPS-FWS</option>
                    <option value="DPS-LMS" {{ old('segment_id', $data->segment_id) == 'DPS-LMS' ? 'selected' : '' }}>DPS-LMS</option>
                    <option value="DPS-PCS" {{ old('segment_id', $data->segment_id) == 'DPS-PCS' ? 'selected' : '' }}>DPS-PCS</option>
                    <option value="DPS-PRS" {{ old('segment_id', $data->segment_id) == 'DPS-PRS' ? 'selected' : '' }}>DPS-PRS</option>
                    <option value="DPS-RMS" {{ old('segment_id', $data->segment_id) == 'DPS-RMS' ? 'selected' : '' }}>DPS-RMS</option>
                    <option value="DSS-ERS" {{ old('segment_id', $data->segment_id) == 'DSS-ERS' ? 'selected' : '' }}>DSS-ERS</option>
                    <option value="DSS-MIS" {{ old('segment_id', $data->segment_id) == 'DSS-MIS' ? 'selected' : '' }}>DSS-MIS</option>
                    <option value="RBS-R01" {{ old('segment_id', $data->segment_id) == 'RBS-R01' ? 'selected' : '' }}>RBS-R01</option>
                    <option value="REG-R01" {{ old('segment_id', $data->segment_id) == 'REG-R01' ? 'selected' : '' }}>REG-R01</option>
                    <option value="DGS-BTR" {{ old('segment_id', $data->segment_id) == 'DGS-BTR' ? 'selected' : '' }}>DGS-BTR</option>
                    <option value="DGS-R01" {{ old('segment_id', $data->segment_id) == 'DGS-R01' ? 'selected' : '' }}>DGS-R01</option>
                </select>

            </div>

            <div class="mb-3">
                <label for="witel" class="form-label">Witel</label>
                <input type="text" class="form-control" id="witel" value="{{ $data->witel }}" name="witel" required>
            </div>

            <!-- Additional Fields -->
            <div class="mb-3">
                <label for="sid" class="form-label">SID</label>
                <input type="text" class="form-control" id="sid" value="{{ $data->sid }}" name="sid" required>
            </div>
            <div class="mb-3">
                <label for="layanan" class="form-label">Layanan</label> 
                <select class="form-select" aria-label="Default select example" id="layanan_id" value="{{ $data->layanan_id }}" name="layanan_id" required>
                    <option selected>Pilih Layanan</option>
                    <option value="High Speed Internet"{{ old('layanan_id', $data->layanan_id) == 'High Speed Internet' ? 'selected' : '' }}>High Speed Internet</option>
                    <option value="Wifi Managed Service"{{ old('layanan_id', $data->layanan_id) == 'Wifi Managed Service' ? 'selected' : '' }}>Wifi Managed Service</option>
                    <option value="Wireline"{{ old('layanan_id', $data->layanan_id) == 'Wireline' ? 'selected' : '' }}>Wireline</option>
                    <option value="Indibiz"{{ old('layanan_id', $data->layanan_id) == 'Indibiz' ? 'selected' : '' }}>Indibiz</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="bandwidth" class="form-label">Bandwidth</label>
                <input type="text" class="form-control" id="bw" value="{{ $data->bw }}" name="bw" required>
            </div>
            <div class="mb-3">
                <label for="kontrak" class="form-label">Kontrak</label>
                <input type="text" class="form-control" id="kontrak" value="{{ $data->kontrak }}" name="kontrak" required>
            </div>
            <div class="mb-3">
                <label for="start_kontrak" class="form-label">Start Kontrak</label>
                <input type="date" class="form-control" id="start" value="{{ $data->start }}" name="start" required>
            </div>
            <div class="mb-3">
                <label for="end_kontrak" class="form-label">End Kontrak</label>
                <input type="date" class="form-control" id="end" value="{{ $data->end }}" name="end" required>
            </div>
            <div class="mb-3">
                <label for="account_manager" class="form-label">Account Manager</label>
                <select class="form-select" aria-label="Default select example" id="am_nm" value="{{ $data->am_nm }}" name="am_nm" required>
                    <option selected>Pilih Account Manager</option>
                    <option value="Windi"{{ old('am_nm', $data->am_nm) == 'Windi' ? 'selected' : '' }}>Windi</option>
                    <option value="Kafi"{{ old('am_nm', $data->am_nm) == 'Kafi' ? 'selected' : '' }}>Kafi</option>
                    <option value="Nadin"{{ old('am_nm', $data->am_nm) == 'Nadin' ? 'selected' : '' }}>Nadin</option>
                    <option value="Fitri"{{ old('am_nm', $data->am_nm) == 'Fitri' ? 'selected' : '' }}>Fitri</option>
                </select>
            </div>

            <!-- Button Save and Cancel -->
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>

        </form>
    </div>
    <script>
        document.querySelector('#updateForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Mencegah submit form langsung

            Swal.fire({
                title: 'Yakin ingin update?',
                text: 'Data akan diupdate dan perubahan tidak dapat dibatalkan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Update!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit form jika user menekan tombol konfirmasi
                }
            });
        });
    </script>

@endsection
