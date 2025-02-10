<x-app-layout>
@extends('layouts.template')

@section('konten')
    <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                
                <!-- TITLE -->
                <h3 class="mb-1">ASSETS</h3>
                @php
                    $firstItem = $data->first();
                @endphp

                @if ($firstItem)
                    <h2 class="text-xs text-gray-400 mb-4">Account Number: {{ $firstItem->acc_num }}</h2>
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">Acc Num</th>
                            <th class="col-md-2">Cus Name</th>
                            <th class="col-md-1">SID</th>
                            <th class="col-md-1">NIPNAS</th>
                            <th class="col-md-1">Segment</th>
                            <th class="col-md-1">Witel</th>
                            <th class="col-md-1">Layanan</th>
                            <th class="col-md-1">Bandwidth</th>
                            <th class="col-md-2">Kontrak</th>
                            <th class="col-md-1">Start</th>
                            <th class="col-md-1">End</th>
                            <th class="col-md-1">AM</th>
                            @if(auth()->user()->role == 'admin')
                            <th class="col-md-1">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item) <!-- Gunakan $item di sini -->
                        <tr>
                            <td>{{ $item->acc_num }}</td> <!-- Gantilah $data menjadi $item -->
                            <td>{{ $item->cust_nm }}</td>
                            <td>{{ $item->sid }}</td>
                            <td>{{ $item->nipnas }}</td>
                            <td>{{ $item->segment_id }}</td>
                            <td>{{ $item->witel }}</td>
                            <td>{{ $item->layanan_id }}</td>
                            <td>{{ $item->bw }}</td>
                            <td>{{ $item->kontrak }}</td>
                            <td>{{ $item->start }}</td>
                            <td>{{ $item->end }}</td>
                            <td>{{ $item->am_nm }}</td>
                            @if(auth()->user()->role == 'admin')
                            <td>
                                <a href="{{ route('assets.edit', $item->sid) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                                <form id="delete-form-{{ $item->sid }}" action="{{ route('assets.destroy', $item->sid) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete({{ $item->sid }})">Delete</button>
                                </form>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               <button type="button" class="btn btn-primary" onclick="window.location.href = '/datin'">Back</button>
          </div>
          @include('komponen.pesan')
          <!-- AKHIR DATA -->
@endsection
</x-app-layout>
