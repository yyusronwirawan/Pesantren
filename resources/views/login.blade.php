<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <title>Login</title>
</head>

<body>
    <div class="wrapper">
        <div class="logo"> <img src="{{asset('NiceAdmin/')}}/assets/img/logo.png" alt="">
        </div>
        <div class="text-center mt-4 "> <b>PERGURUAN ISLAM PESANTREN</b> </div>
        <div class="text-center "> <b>AL MUNTADHOR</b> </div>

        <form class="p-3 mt-3" method="POST" action="{{route('postlogin')}}">
            {{ csrf_field() }}
            <div class="form-field d-flex align-items-center">
                <span for="username" class="far fa-user"></span>
                <input class="form-control" type="text" name="username" id="username" placeholder="Username" required autofocus>
            </div>
            <div class="form-field d-flex align-items-center">
                <span for="password" class="fas fa-key"></span>
                <input class="form-control" type="password" name="password" id="password" placeholder="Password" required autocomplete="current-password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <div class="text-center fs-6"> <a href="{{ route('ForgetPasswordGet') }}" style="color: #ffff">Lupa password?</a> atau <a href="/" style="color: #ffff">Beranda</a> </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>