@if (session('msg'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: 'top-end',
                icon: '{{ session('msg.status') }}',
                title: {!! json_encode(session('msg.message')) !!},
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
    @php session()->forget('msg');
@endif
