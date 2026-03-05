<?php if(session('msg')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: 'top-end',
                icon: '<?php echo e(session('msg.status')); ?>',
                title: <?php echo json_encode(session('msg.message')); ?>,
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
    @php session()->forget('msg');
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\www\modern-news\resources\views/admin/page/sweetalert.blade.php ENDPATH**/ ?>