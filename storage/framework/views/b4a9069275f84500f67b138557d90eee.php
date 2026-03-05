<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    if (session()->has('success')) {
        echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "' . session('success') . '",
                showConfirmButton: false,
                timer: 1500
            });
        </script>';
        session()->forget('success');
    }

    if (session()->has('error')) {
        echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "' . session('error') . '",
                showConfirmButton: false,
                timer: 1500
            });
        </script>';
        session()->forget('error');
    }
?>
<?php /**PATH C:\xampp\htdocs\www\modern-news\resources\views/admin/inc/sweetalert.blade.php ENDPATH**/ ?>