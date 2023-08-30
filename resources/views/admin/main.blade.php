<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Administrator</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('AdminLTE/')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminLTE/')}}/dist/css/adminlte.min.css">
    <script src="https://kit.fontawesome.com/8bf6e38d9a.js" crossorigin="anonymous"></script>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        @yield('container')
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{asset('AdminLTE/')}}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('AdminLTE/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('AdminLTE/')}}/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('AdminLTE/')}}/dist/js/demo.js"></script>
</body>

</html>