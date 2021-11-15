<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('')}}">
	<title>AdminCP | Login</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="admin_template/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="admin_template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="admin_template/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="admin_template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="icon" href="logo/logo.png" type="image/png" sizes="16x16">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">

            <a href="/">
                <img src="logo/logo.png?v={{time()}}" width="150px"  alt="LOGO"><br>
                <b>Admin</b> control panel
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg text-info">Sign in to start your session</p>
                <form action="{{ 'login' }}" method="post" id="login">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="txtEmail" value="{{old('txtEmail')}}" id="email" class="form-control {{session('error') ? 'is-invalid' : '' }} " placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope text-info"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="txtPassword" id="password" class="form-control i {{session('error') ? 'is-invalid' : '' }} " placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock text-info"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-secondary">
                                <input type="checkbox" name="remember" id="remember" checked >
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-outline-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <p class="mt-2">
                    <a href="{{ Request::root() }}" class="text-info"><i class="fas fa-home"></i> Go back home page</a>
                </p>
            </div>
        </div>
    </div>

    <script src="admin_template/plugins/jquery/jquery.min.js"></script>
    <script src="admin_template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="admin_template/dist/js/adminlte.min.js"></script>

    <script type="text/javascript" src="admin_template/plugins/jquery.cookie/jquery.cookie.min.js"></script>
	<script type="text/javascript" src="admin_template/plugins/jquery.cookie/custom.cookie.js"></script>
    <script src="admin_template/plugins/sweetalert2/sweetalert2.min.js"></script>
    @if (session('error'))
        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: true,
                timer: 20000
            });
            Toast.fire({
                icon: 'error',
                title: 'Mật khẩu hoặc tài khoản không chính xác.'
            })
        </script>
    @endif
</body>

</html>
