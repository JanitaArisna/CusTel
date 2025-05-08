@extends('layouts.template')

@section('konten')
@include('komponen.pesan-datin-bill')



<!-- Konten form untuk edit data Bill -->
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3 class="mb-4">EDIT BILL</h3>
    <form id="updateBill" action="{{ route('bill.update', ['acc_num' => $acc_num, 'sid' => $bill->sid, 'tahun' => $bill->tahun]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Input SID -->
        <div class="mb-3">
            <label for="sid" class="form-label">SID</label>
            <input type="text" class="form-control" id="sid" name="sid" value="{{ $bill->sid }}" readonly>
        </div>

        <!-- Input Tahun -->
        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number" class="form-control" id="tahun" name="tahun" value="{{ old('tahun', $bill->tahun) }}" readonly>
        </div>

        <!-- Input Bulan (Januari - Desember) -->
        @foreach(['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'] as $bulan)
        <div class="mb-3">
            <label for="{{ $bulan }}" class="form-label">{{ ucfirst($bulan) }}</label>
            <input type="number" class="form-control" id="{{ $bulan }}" name="{{ $bulan }}" value="{{ old($bulan, $bill->$bulan) }}">
        </div>
        @endforeach

        <!-- Button Update and Cancel -->
        <button type="submit" class="btn btn-success">Update</button>
        <a href="#" class="btn btn-danger btn-cancel-edit">Cancel</a>
    </form>

    <script>
    // Kode JavaScript ini untuk tahun yang bisa di tambah 1 tahun dari tahun sekarang
    const tahunInput = document.getElementById('tahun');

    tahunInput.addEventListener('input', function() {
        const tahunSekarang = new Date().getFullYear();
        const tahunMaksimal = tahunSekarang + 1;
        const nilaiInput = parseInt(this.value);

        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 4) {
        this.value = this.value.slice(0, 4);
        }

        if (!isNaN(nilaiInput) && nilaiInput > tahunMaksimal) {
        this.value = tahunMaksimal;
        }
    });
    // Kode JavaScript ini untuk mengaktifkan input bulan berikutnya jika bulan saat ini diisi
    // dan menonaktifkan input bulan berikutnya jika bulan sebelumnya kosong
    const bulanInputs = [
    'januari', 'februari', 'maret', 'april', 'mei', 'juni',
    'juli', 'agustus', 'september', 'oktober', 'november', 'desember'
    ];

    bulanInputs.forEach((bulan, index) => {
    const inputBulan = document.getElementById(bulan);

    if (inputBulan) {
        inputBulan.addEventListener('input', function() {
        // Aktifkan input bulan berikutnya jika bulan saat ini diisi
        if (index < bulanInputs.length - 1) {
            const inputBerikutnya = document.getElementById(bulanInputs[index + 1]);
            if (inputBerikutnya && this.value.trim() !== '') {
            inputBerikutnya.disabled = false;
            }
        }
        });

        // Saat halaman dimuat, nonaktifkan input setelah bulan pertama yang kosong
        if (index > 0) {
        const inputSebelumnya = document.getElementById(bulanInputs[index - 1]);
        if (inputSebelumnya && inputSebelumnya.value.trim() === '') {
            inputBulan.disabled = true;
        }
        }
    }
    });
    </script>
</div>

@endsection
