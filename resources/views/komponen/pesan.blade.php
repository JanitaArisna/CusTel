
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
