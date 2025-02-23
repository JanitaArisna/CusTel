
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

<!--Alert ketika mau merubah data untuk di Update -->
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







