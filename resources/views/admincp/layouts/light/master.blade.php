<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{asset('')}}">
    <title>@yield('title')</title>
    <!-- Flag icon -->
    <link rel="stylesheet" href="flag-icon/css/flag-icon.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="admin_template/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="admin_template/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="admin_template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="admin_template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="admin_template/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="admin_template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- custom style -->
    <link rel="stylesheet" href="admin_template/customs/general.css?v={{time()}}">
    @stack('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    @include('admincp.layouts.light.navbar')
    <!-- Main Sidebar Container -->
    @include('admincp.layouts.light.main-sidebar')
    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
        <b>Version</b> 1 {{App::getLocale()}}
        </div>
        <strong>Copyright &copy; 2020 - {{date('Y')}} <a href="/">{{parse_url(Request::root())['host']}}</a>.</strong> All rights reserved.
    </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="admin_template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="admin_template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="admin_template/dist/js/adminlte.min.js"></script>
<!-- Bootstrap Switch -->
<script src="admin_template/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="admin_template/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="admin_template/plugins/select2/js/select2.full.min.js"></script>
<!-- Customs VHN -->
<script src="admin_template/customs/sidebar.js?v={{time()}}"></script>
<script src="admin_template/customs/general.js?v={{time()}}"></script>
<script src="admin_template/customs/function.js?v={{time()}}"></script>
<script>
    window._locale = '{{ app()->getLocale() }}';
    window._translations = {!! cache('translations') !!};
    window.lang = _translations[_locale][0];
</script>
@include('admincp.layouts.light.alert')

@stack('scripts')


</body>
</html>
