<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--KHUSUS CREATE BILL NON DATIN-------------------------------->
@if(session('error'))
    <script>
        var pesanError = "{{ session('error') }}";
        if (pesanError === 'nonduplicate_year') {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Data untuk tahun ini sudah ada!',
            });
        } else if (pesanError === 'non_no_month_no_year') {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Setidaknya satu bulan harus diisi, dan tahun harus diisi.',
            });
        } else if (pesanError === 'non_no_month') {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Setidaknya satu bulan harus diisi.',
            });
        } else if (pesanError === 'non_no_year') {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Tahun harus diisi.',
            });
        }
    </script>
@endif

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data Bill berhasil disimpan!',
        });
    </script>
@endif
<script>
    // Kode JavaScript untuk konfirmasi sebelum membatalkan perubahan
    document.addEventListener('DOMContentLoaded', function () {
        const cancelBtn = document.querySelector('.btn-cancel-create');
        const cancelUrl = "{{ route('nonbill.show', ['cca' => $cca, 'snd' => $snd]) }}";

        cancelBtn.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Batalkan pembuatan?',
                text: "Data yang sudah diisi akan hilang.",
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

<!--AKHIR KHUSUS CREATE BILL NON DATIN--------------------------->

<!--KHUSUS DELETE BILL NON DATIN-------------------------------->
@if(session('delete_success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data Bill berhasil dihapus!',
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
                    text: "Data Bill akan dihapus secara permanen!",
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
<!--AKHIR KHUSUS DELETE BILL NON DATIN--------------------------->

<!--KHUSUS EDIT BILL NON DATIN---------------------------------->
@php
    $pesanSuccess = session('success') ?? request('success');
@endphp

@if($pesanSuccess)
    <script>
        var pesanSuccess = "{{ $pesanSuccess }}";
        if (pesanSuccess === 'bill_updated') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data Bill berhasil diperbarui!',
            });
        }
        else if (pesanSuccess === 'bill_not_updated') {
            Swal.fire({
                icon: 'info',
                title: 'Dibatalkan',
                text: 'Perubahan dibatalkan.',
            });
        }

        // Hapus parameter 'success' dari URL agar tidak muncul saat refresh
        if (history.replaceState) {
            const url = new URL(window.location);
            url.searchParams.delete('success');
            window.history.replaceState({}, document.title, url.pathname + url.search);
        }
    </script>
@endif
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let updateForm = document.querySelector('#updateNonBill');
            if (updateForm) {
                updateForm.addEventListener('submit', function (event) {
                    event.preventDefault(); // Mencegah submit form langsung

                    Swal.fire({
                        title: 'Yakin ingin update?',
                        text: 'Data Bill akan diupdate dan perubahan tidak dapat dibatalkan.',
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
            // Kode JavaScript untuk konfirmasi sebelum membatalkan perubahan
            document.addEventListener('DOMContentLoaded', function () {
                const cancelBtn = document.querySelector('.btn-cancel-edit');
                const cancelUrl = "{{ route('nonbill.show', ['cca' => $cca, 'snd' => $snd]) }}";

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
                            window.location.href = cancelUrl + '?success=bill_not_updated'; // Tambahkan parameter error
                        }
                    });
                });
            });
        </script>
<!--AKHIR KHUSUS EDIT BILL NON DATIN--------------------------->