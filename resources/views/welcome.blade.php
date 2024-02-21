<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="../css/login.css" rel="stylesheet">

</head>

<body class="login_body">
    <div class="container">
        <div class="row">
            <form  action="loginData" method='post' class="login_form col-sm-4 offset-sm-4 p-3 mt-5">
                @csrf
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible"> {{$error}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @break
                @endforeach
                @endif
                @if(Session::has('fail'))
                <div class="alert alert-danger alert-dismissible"> {{Session::get('fail')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}" required></input>
                <input type="password" class="form-control mt-3" placeholder="Password" name="password" value="{{old('password')}}" required></input>
                <input type="submit" class="btn btn-primary col-4 offset-4 mt-5 mb-5"></input>
                <a href="signup" class="signup_anchor">SignUp</a>
            </form>
            <div>
                <div>
</body>

</html>