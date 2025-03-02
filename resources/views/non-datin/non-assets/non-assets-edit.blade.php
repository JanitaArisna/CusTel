@extends('layouts.template')

@section('konten')

    <!-- Konten form untuk edit data -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="mb-4">EDIT DATA PELANGGAN</h3>
        <form action="{{ route('non-datin.assets.update', ['cca' => $data->cca, 'snd' => $data->snd]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="cca" class="form-label">CCA</label>
                <input type="text" class="form-control" id="cca" value="{{ $data->cca }}" name="cca" readonly>
            </div>
            <div class="mb-3">
                <label for="snd" class="form-label">SND</label>
                <input type="text" class="form-control" id="snd" value="{{ $data->snd }}" name="snd" readonly>
            </div>
            <div class="mb-3">
                <label for="snd_g" class="form-label">SND Group</label>
                <input type="text" class="form-control" id="snd_g" value="{{ $data->snd_g }}" name="snd_g" required>
            </div>
            <div class="mb-3">
                <label for="ncli" class="form-label">NCLI</label>
                <input type="text" class="form-control" id="ncli" value="{{ $data->ncli }}" name="ncli" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" value="{{ $data->nama }}" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Address</label>
                <input type="text" class="form-control" id="alamat" value="{{ $data->alamat }}" name="alamat" required>
            </div>
            <div class="mb-3">
                <label for="sto" class="form-label">STO</label>
                <select class="form-select" id="sto" name="sto" required>
                    <option disabled>Pilih STO</option>
                    <option value="Kabil" {{ $data->sto == 'Kabil' ? 'selected' : '' }}>Kabil</option>
                    <option value="Panbil" {{ $data->sto == 'Panbil' ? 'selected' : '' }}>Panbil</option>
                    <option value="Nongsa" {{ $data->sto == 'Nongsa' ? 'selected' : '' }}>Nongsa</option>
                    <option value="Batam Center" {{ $data->sto == 'Batam Center' ? 'selected' : '' }}>Batam Center</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="segment_non" class="form-label">Segment</label>
                <select class="form-select" id="segment_non" name="segment_non" required>
                    <option disabled>Pilih Segment</option>
                    <option value="RBS" {{ $data->segment_non == 'RBS' ? 'selected' : '' }}>RBS</option>
                    <option value="DGS" {{ $data->segment_non == 'DGS' ? 'selected' : '' }}>DGS</option>
                    <option value="DPS" {{ $data->segment_non == 'DPS' ? 'selected' : '' }}>DPS</option>
                    <option value="DSS" {{ $data->segment_non == 'DSS' ? 'selected' : '' }}>DSS</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="produk" class="form-label">Produk</label>
                <select class="form-select" id="produk" name="produk" required>
                    <option disabled>Pilih Produk</option>
                    <option value="Indibiz" {{ $data->produk == 'Indibiz' ? 'selected' : '' }}>Indibiz</option>
                    <option value="WMS" {{ $data->produk == 'WMS' ? 'selected' : '' }}>WMS</option>
                    <option value="Network" {{ $data->produk == 'Network' ? 'selected' : '' }}>Network</option>
                    <option value="Antares Eazy" {{ $data->produk == 'Antares Eazy' ? 'selected' : '' }}>Antares Eazy</option>
                    <option value="Pijar" {{ $data->produk == 'Pijar' ? 'selected' : '' }}>Pijar</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="desc_newbill" class="form-label">Desc Newbill</label>
                <select class="form-select" id="desc_newbill" name="desc_newbill" required>
                    <option disabled>Pilih Desc Newbill</option>
                    <option value="PRA NPC" {{ $data->desc_newbill == 'PRA NPC' ? 'selected' : '' }}>PRA NPC</option>
                    <option value="C3MR" {{ $data->desc_newbill == 'C3MR' ? 'selected' : '' }}>C3MR</option>
                    <option value="WINBACK" {{ $data->desc_newbill == 'WINBACK' ? 'selected' : '' }}>WINBACK</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="bundling" class="form-label">Bundling</label>
                <select class="form-select" id="bundling" name="bundling" required>
                    <option disabled >Pilih Bundling</option>
                    <option value="1P" {{ $data->produk =='1P' ? 'selected' : '' }}>1P</option>
                    <option value="2P" {{ $data->produk == '2P' ? 'selected' : '' }}>2P</option>
                    <option value="3P" {{ $data->produk == '3P' ? 'selected' : '' }}>3P</option>
                    <option value="Internet Only" {{ $data->produk == 'Internet Only' ? 'selected' : '' }}>Internet Only</option>
                    <option value="Internet dan Telpon" {{ $data->produk == 'Internet dan Telpon' ? 'selected' : '' }}>Internet dan Telpon</option>
                    <option value="Internet TV Box dan Telpon" {{ $data->produk == 'Internet TV Box dan Telpon' ? 'selected' : '' }}>Internet TV Box dan Telpon</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="manager" class="form-label">Accountn Manager</label>
                <select class="form-select" id="manager" name="manager" required>
                    <option disabled>Pilih Account Manager</option>
                    <option value="Janita" {{ $data->status == 'Janita' ? 'selected' : '' }}>Janita</option>
                    <option value="Nabila" {{ $data->status == 'Nabila' ? 'selected' : '' }}>Nabila</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="start_kontrak" class="form-label">Start Kontrak</label>
                <input type="date" class="form-control" id="start" value="{{ $data->start }}" name="start" required>
            </div>
            <div class="mb-3">
                <label for="end_kontrak" class="form-label">End Kontrak</label>
                <input type="date" class="form-control" id="end" value="{{ $data->end }}" name="end" required>
            </div>
            <!-- Button Save and Cancel -->
            <button type="submit" class="btn btn-success">Update</button>
            <a href='{{ route('non-datin.assets.index', ['cca' => $data->cca]) }}' class="btn btn-danger">Cancel</a>
        </form>
    </div>
@endsection
