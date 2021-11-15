@if (session('error'))
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 20000
        });
        Swal.fire({
            icon: 'error',
            title: lang.alert.update_error
        })
    </script>
@endif
@if (session('success'))
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 20000
        });
        Swal.fire({
            icon: 'success',
            title: lang.alert.update_success
        })
    </script>
@endif
@if (session('warning'))
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 20000
        });
        Swal.fire({
            icon: 'warning',
            title: lang.alert.warning_success
        })
    </script>
@endif

@if (session('permission'))
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 20000
        });
        Swal.fire({
            icon: 'warning',
            title: lang.alert.permission
        })
    </script>
@endif
