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
            title: lang.alert.update_error,
            timer: 5000,
        })
    </script>
@endif
@if (session('success'))
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 200
        });
        Swal.fire({
            icon: 'success',
            title: lang.alert.update_success,
            timer: 1000,
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
            title: lang.alert.warning_success,
            timer: 5000,
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
            title: lang.alert.permission,
            timer: 5000,
        })
    </script>
@endif
@if (session('quantity'))
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 20000
        });
        Swal.fire({
            icon: 'warning',
            title: 'số lượng không đủ, đã reset các sp trên đơn hàng này, cần kiểm tra lại',
            timer: 5000,
        })
    </script>
@endif
