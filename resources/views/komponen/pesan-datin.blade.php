<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!--KHUSUS INDEX DAN CREATE MAIN DATIN----------------------------->
@if(session('success_datin'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data Datin berhasil disimpan!',
        });
    </script>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            var searchInput = document.getElementById('searchInput').value.trim();

            if (!searchInput) {
                e.preventDefault(); // Stop form submit
                Swal.fire({
                    icon: 'warning',
                    title: 'Pencarian Kosong',
                    text: 'Silakan masukkan kata kunci sebelum melakukan pencarian. Jika Anda ingin kembali melihat semua data, klik tombol "Ya".',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, kembali ke awal',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ url('/datin') }}";
                    }
                });
            }
        });
    });
</script>
    <script>
            // Kode JavaScript untuk konfirmasi sebelum membatalkan perubahan
            document.addEventListener('DOMContentLoaded', function () {
                const cancelBtn = document.querySelector('.btn-cancel-datin-create');
                const cancelUrl = "/datin"; // Ganti dengan URL yang sesuai untuk membatalkan pembuatan

                cancelBtn.addEventListener('click', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Batalkan pembuatan?',
                        text: "Data Datin yang sudah diisi akan hilang.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, batalkan',
                        cancelButtonText: 'Lanjutkan Pengisian'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = cancelUrl + '?info=creation_canceled'; // Tambahkan parameter error
                        }
                    });
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            // Cek apakah ada parameter 'info' dengan nilai 'creation_canceled' di URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('info') === 'creation_canceled') {
                Swal.fire({
                    title: 'Pembatalan Berhasil',
                    text: 'Pembuatan Data Datin telah dibatalkan.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                });

                const url = new URL(window.location);
                url.searchParams.delete('info'); // Hapus parameter 'info' dari URL
                window.history.replaceState({}, document.title, url.pathname + url.search);
                }
            });
        </script>
<!--AKHIR INDEX DAN CREATE MAIN DATIN----------------------------->

<!--KHUSUS EDIT DATIN-------------------------------->
@if(session('success_datin_update'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data Asset berhasil diubah!',
        });
    </script>
@endif

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let updateForm = document.querySelector('#updateDatin');
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cancelBtn = document.querySelector('.btn-cancel-datin-edit');
            const cancelUrl = "{{ route('assets.show', ['acc_num' => $acc_num ?? 'default']) }}";

            cancelBtn.addEventListener('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Batalkan perubahan?',
                    text: "Perubahan yang belum disimpan akan hilang.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, batalkan',
                    cancelButtonText: 'Lanjutkan Edit'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = cancelUrl + '?info=creation_datin';
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        // Cek apakah ada parameter 'info' dengan nilai 'creation_canceled' di URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('info') === 'creation_datin') {
            Swal.fire({
                title: 'Pembatalan Berhasil',
                text: 'Pembuatan data telah dibatalkan.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false,
            });

            const url = new URL(window.location);
            url.searchParams.delete('info'); // Hapus parameter 'info' dari URL
            window.history.replaceState({}, document.title, url.pathname + url.search);
            }
        });
    </script>
<!--AKHIR EDIT DATIN----------------------------->
<!--KHUSUS DELETE DATIN-------------------------------->
@if(session('success_datin_delete'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data Asset berhasil dihapus!',
        });
    </script>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.form-delete');
                
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data Asset akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
<!--AKHIR DELETE DATIN--------------------------------->

