<!-- resources/views/datin/datin.blade.php -->
<x-app-layout>
@extends('layouts.template')

@section('konten')
    <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                
                <!-- TITLE -->
                <h3 class="mb-4">REVENUE DATIN</h3>
                
                <!-- FORM PENCARIAN -->
                <div class="pb-3 d-flex">
                  <form class="d-flex" action="" method="get">
                      <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search" style="width: 200px;">
                      <button class="btn btn-secondary me-3" type="submit">Cari</button>
                  </form>
                  <select class="select-filter me-1">
                    <option value="all">All</option>
                    <option value="option1">Date</option>
                    <option value="option2">Month</option>
                    <option value="option3">New Customer</option>
                  </select>
                  <a href='' class="btn btn-outline-dark me-3">Filter</a>
                  @if(auth()->user()->role == 'admin')
                  <a href='{{ url('datin/create') }}' class="btn btn-success">+ Tambah Data</a>
                  @endif
                  
                </div>
          
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-2">Account Number</th>
                            <th class="col-md-2">Customer Name</th>
                            <th class="col-md-1">NIPNAS</th>
                            <th class="col-md-1">Segment</th>
                            <th class="col-md-1">Witels</th>
                            <th class="col-md-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $data->firstItem() ?>
                        <?php $lastAccNum = null; ?>
                        @foreach ($data as $item)
                        @if ($item->acc_num != $lastAccNum)
                        <tr>    
                            <td>{{ $i }}</td>
                            <td>{{ $item->acc_num }}</td>
                            <td>{{ $item->cust_nm }}</td>
                            <td>{{ $item->nipnas }}</td>
                            <td>{{ $item->segment_id }}</td>
                            <td>{{ $item->witel }}</td>
                            <td>
                                <a href="{{ url('datin/'.$item->acc_num.'/assets') }}" class="btn btn-outline-dark btn-sm">Assets</a>
                                <a href="{{ url('datin/'.$item->acc_num.'/bill') }}" class="btn btn-outline-dark btn-sm">Bill</a>
                            </td>
                        </tr>
                        <?php $lastAccNum = $item->acc_num; ?>
                        <?php $i++ ?>
                        @endif
                        @endforeach
                    </tbody>
                </table>
               {{ $data->withQueryString()->links() }}
          </div>
          <!-- <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Yakin akan menghapus data?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika tombol konfirmasi ditekan, submit form
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
          </script>-->

          <!-- AKHIR DATA -->
@endsection
</x-app-layout>