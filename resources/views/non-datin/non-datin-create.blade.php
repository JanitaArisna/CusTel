@extends('layouts.template')

@section('konten')

    <!-- Konten form untuk tambah data -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="mb-4">INPUT DATA PELANGGAN BARU</h3>
        <form action="{{ route('non-datin.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="cca" class="form-label">CCA</label>
                <input type="text" class="form-control" id="cca" value="{{ Session::get('cca') }}" name="cca" required>
            </div>
            <div class="mb-3">
                <label for="snd" class="form-label">SND</label>
                <input type="text" class="form-control" id="snd" value="{{ Session::get('snd') }}" name="snd" required>
            </div>
            <div class="mb-3">
                <label for="snd_g" class="form-label">SND Group</label>
                <input type="text" class="form-control" id="snd_g" value="{{ Session::get('snd_g') }}" name="snd_g" required>
            </div>
            <div class="mb-3">
                <label for="ncli" class="form-label">NCLI</label>
                <input type="text" class="form-control" id="ncli" value="{{ Session::get('ncli') }}" name="ncli" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" value="{{ Session::get('nama') }}" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Address</label>
                <input type="text" class="form-control" id="alamat" value="{{ Session::get('alamat') }}" name="alamat" required>
            </div>
            <div class="mb-3">
                <label for="sto" class="form-label">STO</label>
                <select class="form-select" aria-label="Default select example" id="sto" name="sto" required>
                    <option disabled {{ is_null(Session::get('sto')) ? 'selected' : '' }}>Pilih STO</option>
                    <option value="Kabil" {{ Session::get('sto') == 'Kabil' ? 'selected' : '' }}>Kabil</option>
                    <option value="Panbil" {{ Session::get('sto') == 'Panbil' ? 'selected' : '' }}>Panbil</option>
                    <option value="Nongsa" {{ Session::get('sto') == 'Nongsa' ? 'selected' : '' }}>Nongsa</option>
                    <option value="Batam Center" {{ Session::get('sto') == 'Batam Center' ? 'selected' : '' }}>Batam Center</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="segment_non" class="form-label">Segment</label>
                <select class="form-select" aria-label="Default select example" id="segment_non" name="segment_non" required>
                    <option disabled {{ is_null(Session::get('segment_non')) ? 'selected' : '' }}>Pilih Segment</option>
                    <option value="RBS" {{ Session::get('segment_non') == 'RBS' ? 'selected' : '' }}>RBS</option>
                    <option value="DGS" {{ Session::get('segment_non') == 'DGS' ? 'selected' : '' }}>DGS</option>
                    <option value="DPS" {{ Session::get('segment_non') == 'DPS' ? 'selected' : '' }}>DPS</option>
                    <option value="DSS" {{ Session::get('segment_non') == 'DSS' ? 'selected' : '' }}>DSS</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="produk" class="form-label">Produk</label>
                <select class="form-select" aria-label="Default select example" id="produk" name="produk" required>
                    <option disabled {{ is_null(Session::get('produk')) ? 'selected' : '' }}>Pilih Produk</option>
                    <option value="Indibiz" {{ Session::get('produk') == 'Indibiz' ? 'selected' : '' }}>Indibiz</option>
                    <option value="WMS" {{ Session::get('produk') == 'WMS' ? 'selected' : '' }}>WMS</option>
                    <option value="Network" {{ Session::get('produk') == 'Network' ? 'selected' : '' }}>Network</option>
                    <option value="Antares Eazy" {{ Session::get('produk') == 'Antares Eazy' ? 'selected' : '' }}>Antares Eazy</option>
                    <option value="Pijar" {{ Session::get('produk') == 'Pijar' ? 'selected' : '' }}>Pijar</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="desc_newbill" class="form-label">Desc NewBill</label>
                <select class="form-select" aria-label="Default select example" id="desc_newbill" name="desc_newbill" required>
                    <option disabled {{ is_null(Session::get('desc_newbill')) ? 'selected' : '' }}>Pilih Desc NewBill</option>
                    <option value="PRA NPC" {{ Session::get('desc_newbill') == 'PRA NPC' ? 'selected' : '' }}>PRA NPC</option>
                    <option value="C3MR" {{ Session::get('desc_newbill') == 'C3MR' ? 'selected' : '' }}>C3MR</option>
                    <option value="WINBACK" {{ Session::get('desc_newbill') == 'WINBACK' ? 'selected' : '' }}>WINBACK</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="bundling" class="form-label">Bundling</label>
                <select class="form-select" aria-label="Default select example" id="bundling" name="bundling" required>
                    <option disabled {{ is_null(Session::get('bundling')) ? 'selected' : '' }}>Pilih Bundling</option>
                    <option value="1P" {{ Session::get('bundling') == '1P' ? 'selected' : '' }}>1P</option>
                    <option value="2P" {{ Session::get('bundling') == '2P' ? 'selected' : '' }}>2P</option>
                    <option value="3P" {{ Session::get('bundling') == '3P' ? 'selected' : '' }}>3P</option>
                    <option value="Internet Only" {{ Session::get('bundling') == 'Internet Only' ? 'selected' : '' }}>Internet Only</option>
                    <option value="Internet dan Telpon" {{ Session::get('bundling') == 'Internet dan Telpon' ? 'selected' : '' }}>Internet dan Telpon</option>
                    <option value="Internet TV Box dan Telpon" {{ Session::get('bundling') == 'Internet TV Box dan Telpon' ? 'selected' : '' }}>Internet TV Box dan Telpon</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="start_kontrak" class="form-label">Start Kontrak</label>
                <input type="date" class="form-control" id="start" value="{{ Session::get('start') }}" name="start" required>
            </div>
            <div class="mb-3">
                <label for="end_kontrak" class="form-label">End Kontrak</label>
                <input type="date" class="form-control" id="end" value="{{ Session::get('end') }}" name="end" required>
            </div>

            <!-- Button Save and Cancel -->
            <button type="submit" class="btn btn-success">Save</button>
            <a href='{{ url('non-datin') }}' class="btn btn-danger">Cancel</a>

        </form>
    </div>
@endsection