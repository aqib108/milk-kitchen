<script>
    $(function () {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        @if (session('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        })
        @endif

        @if (session('error'))
        Toast.fire({
            icon: 'error',
            title: '{{ session('error') }}'
        })
        @endif

        @if (session('info'))
        Toast.fire({
            icon: 'info',
            title: '{{ session('info') }}'
        })
        @endif
    });
</script>