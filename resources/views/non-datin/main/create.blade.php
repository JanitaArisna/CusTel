@extends('layouts.template')
@include('komponen.pesan-nondatin')

@section('konten')

    <!-- Konten form untuk tambah data -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="mb-4">INPUT DATA PELANGGAN BARU</h3>
        <form action="{{ route('non-datin.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="cca" class="form-label">CCA</label>
                <input type="text" class="form-control" id="cca" value="{{ Session::get('cca') }}" name="cca">
            </div>
            <div class="mb-3">
                <label for="snd" class="form-label">SND</label>
                <input type="text" class="form-control" id="snd" value="{{ Session::get('snd') }}" name="snd">
            </div>
            <div class="mb-3">
                <label for="snd_g" class="form-label">SND Group</label>
                <input type="text" class="form-control" id="snd_g" value="{{ Session::get('snd_g') }}" name="snd_g">
            </div>
            <div class="mb-3">
                <label for="ncli" class="form-label">NCLI</label>
                <input type="text" class="form-control" id="ncli" value="{{ Session::get('ncli') }}" name="ncli">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" value="{{ Session::get('nama') }}" name="nama">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Address</label>
                <input type="text" class="form-control" id="alamat" value="{{ Session::get('alamat') }}" name="alamat">
            </div>
            <div class="mb-3">
                <label for="sto" class="form-label">STO</label>
                <select class="form-select" aria-label="Default select example" id="sto" name="sto">
                    <option disabled {{ is_null(Session::get('sto')) ? 'selected' : '' }}>Pilih STO</option>
                    <option value="Kabil" {{ Session::get('sto') == 'Kabil' ? 'selected' : '' }}>Kabil</option>
                    <option value="Panbil" {{ Session::get('sto') == 'Panbil' ? 'selected' : '' }}>Panbil</option>
                    <option value="Nongsa" {{ Session::get('sto') == 'Nongsa' ? 'selected' : '' }}>Nongsa</option>
                    <option value="Batam Center" {{ Session::get('sto') == 'Batam Center' ? 'selected' : '' }}>Batam Center</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="segment_non" class="form-label">Segment</label>
                <select class="form-select" aria-label="Default select example" id="segment_non" name="segment_non">
                    <option disabled {{ is_null(Session::get('segment_non')) ? 'selected' : '' }}>Pilih Segment</option>
                    <option value="RBS" {{ Session::get('segment_non') == 'RBS' ? 'selected' : '' }}>RBS</option>
                    <option value="DGS" {{ Session::get('segment_non') == 'DGS' ? 'selected' : '' }}>DGS</option>
                    <option value="DPS" {{ Session::get('segment_non') == 'DPS' ? 'selected' : '' }}>DPS</option>
                    <option value="DSS" {{ Session::get('segment_non') == 'DSS' ? 'selected' : '' }}>DSS</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="produk" class="form-label">Produk</label>
                <select class="form-select" aria-label="Default select example" id="produk" name="produk">
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
                <select class="form-select" aria-label="Default select example" id="desc_newbill" name="desc_newbill">
                    <option disabled {{ is_null(Session::get('desc_newbill')) ? 'selected' : '' }}>Pilih Desc NewBill</option>
                    <option value="PRA NPC" {{ Session::get('desc_newbill') == 'PRA NPC' ? 'selected' : '' }}>PRA NPC</option>
                    <option value="C3MR" {{ Session::get('desc_newbill') == 'C3MR' ? 'selected' : '' }}>C3MR</option>
                    <option value="WINBACK" {{ Session::get('desc_newbill') == 'WINBACK' ? 'selected' : '' }}>WINBACK</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="bundling" class="form-label">Bundling</label>
                <select class="form-select" aria-label="Default select example" id="bundling" name="bundling">
                    <option disabled {{ is_null(Session::get('bundling')) ? 'selected' : '' }}>Pilih Bundling</option>
                    <option value="1P" {{ Session::get('bundling') == '1P' ? 'selected' : '' }}>1P</option>
                    <option value="2P" {{ Session::get('bundling') == '2P' ? 'selected' : '' }}>2P</option>
                    <option value="3P" {{ Session::get('bundling') == '3P' ? 'selected' : '' }}>3P</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="manager" class="form-label">Account Manager</label>
                <select class="form-select" id="manager" name="manager">
                    <option disabled {{ is_null(Session::get('manager')) ? 'selected' : '' }}>Pilih Account Manager</option>
                    <option value="Oktorio Saragih" {{ Session::get('manager') == 'Oktorio Saragih' ? 'selected' : '' }}>Oktorio Saragih</option>
                    <option value="Tiara Wulandari" {{ Session::get('manager') == 'Tiara Wulandari' ? 'selected' : '' }}>Tiara Wulandari</option>
                    <option value="Ariesta Mirania Fabiola" {{ Session::get('manager') == 'Ariesta Mirania Fabiola' ? 'selected' : '' }}>Ariesta Mirania Fabiola</option>
                    <option value="King Abdul Aziz" {{ Session::get('manager') == 'King Abdul Aziz' ? 'selected' : '' }}>King Abdul Aziz</option>
                    <option value="Muhammad Rizky" {{ Session::get('manager') == 'Muhammad Rizky' ? 'selected' : '' }}>Muhammad Rizky</option>
                    <option value="Ismael Marzuki" {{ Session::get('manager') == 'Ismael Marzuki' ? 'selected' : '' }}>Ismael Marzuki</option>

                </select>
            <div class="mb-3">
                <label for="start_kontrak" class="form-label">Date of Subscription</label>
                <input type="date" class="form-control" id="start" value="{{ Session::get('start') }}" name="start">
            </div>

            <!-- Button Save and Cancel -->
            <button type="submit" class="btn btn-success">Save</button>
            <a href="" class="btn btn-danger btn-cancel-nondatin-create">Cancel</a>

        </form>
    </div>

@endsection