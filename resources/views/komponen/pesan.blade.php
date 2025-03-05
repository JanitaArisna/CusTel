
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- @if (Session::has('success'))
    <div class="pt-3">
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    </div>
@endif-->

<!--Alert Untuk Tambah Data ketika berhasil -->

@if(session('success_add'))

<script>
    Swal.fire({
        title: "Sukses!",
        html: "Berhasil menambahkan data dari <br><br> " +
        "Customer Name: <b>{{ session('cust_nm') }}</b> <br>" +
        "Account Number: <b>{{ session('acc_num') }}</b> <br><br>" +
        "Data yang sama dengan Account Number: <b>{{ session('acc_num') }}</b> akan otomatis masuk ke dalam Assets",
        icon: "success",  // Bisa diubah ke "warning", "error", "info"
        confirmButtonText: "OK",
        showCancelButton: false,  // Jika ingin menampilkan tombol batal, ubah ke true
        timer: false,  // Menutup alert otomatis dalam 3 detik (opsional)
        timerprogressbar: false  // Menampilkan progress bar saat timer berjalan
    });
</script>
@endif



<!--Alert Untuk Update Data -->

@if(session('success_update'))
<script>
    Swal.fire({
        title: "Sukses!",
        html: "Berhasil mengubah data dari <br><br> " + 
        "Customer Name: <b>{{ session('cust_nm') }}</b> <br>" +
        "Account Number: <b>{{ session('acc_num') }}</b> <br>" +
        "SID: <b>{{ session('sid') }}</b>",
        icon: "success",  // Bisa diubah ke "warning", "error", "info"
        confirmButtonText: "OK",
        showCancelButton: false,  // Jika ingin menampilkan tombol batal, ubah ke true
        timer: 10000,  // Menutup alert otomatis dalam 3 detik (opsional)
        timerProgressBar: true  // Menampilkan progress bar saat timer berjalan
    });
</script>
    @endif

<!--Alert Untuk Hapus Data -->
<script>
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
</script>





<!--Alert ketika mau merubah data untuk di Update Datin dan Non Datin ---------------------------------------------->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let updateForm = document.querySelector('#updateForm');
        if (updateForm) {
            updateForm.addEventListener('submit', function (event) {
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
        }
    });
</script>
<!--Alert ketika mau merubah data untuk di Update Datin dan Non Datin ---------------------------------------------->





<!--Alert Bill Non Datin Edit, Error pada Bill Dan Delete ----------------------------------------------->
@if (session()->has('succes_CreateNonDatinBill'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('succes_CreateNonDatinBill') }}",
            showConfirmButton: true
        });
    </script>
@endif
@if (session('success_UpdateNonDatinBill'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success_UpdateNonDatinBill') }}",
            showConfirmButton: true
        });
    </script>
@endif

@if (session('error_ErrorNonDatinBill'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ session('error_ErrorNonDatinBill') }}",
            showConfirmButton: true
        });
    </script>
@endif
<!- Alert Delete Untuk Assets dan Bill Non Datin------->
<script>
function confirmDelete(snd) {
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
            document.getElementById('delete-form-' + snd).submit();
        }
    });
    }
</script>
<!--Alert Bill Non Datin Edit, Error pada Bill Dan Delete ----------------------------------------------->


<!--Alert Assets Non Datin Edit, Error pada Assets Dan Delete ----------------------------------------------->
@if (session()->has('success_CreateAssetsNonDatin'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success_CreateAssetsNonDatin') }}",
            showConfirmButton: true
        });
    </script>
@endif

@if (session('success_UpdateAssetsNonDatin'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success_UpdateAssetsNonDatin') }}",
            showConfirmButton: true
        });
    </script>
@endif
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if ($errors->any())
            let errorMessages = "";
            @foreach ($errors->all() as $error)
                errorMessages += "🚫 {{ $error }}<br>"; // Menggunakan <br> sebagai pemisah
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: errorMessages, // Menggunakan html agar format tetap rapi
            });
        @endif
    });
</script>


<!--Alert Assets Non Datin Edit, Error pada Assets Dan Delete ----------------------------------------------->