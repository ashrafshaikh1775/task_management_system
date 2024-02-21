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

<body class="signup_body">
    <div class="container">
        <div class="row">
            <form action="registerData" method='post' class="signup_form col-sm-4 offset-sm-4 p-3 mt-5">

                @csrf
                <div class="outer_div">
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible"> {{$error}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @break
                    @endforeach
                    @endif
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible"> {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger alert-dismissible"> {{ Session::get('fail') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <input type="text" class="form-control mt-3" name='name' placeholder="Name" value="{{old('name')}}"
                        required></input>
                    <input type="email" class="form-control mt-3" name='email' placeholder="Email"
                        value="{{old('email')}}" required></input>
                    <input type="password" class="form-control mt-3" name='password' placeholder="Password"
                        value="{{old('password')}}" required></input>
                    <input type="number" class="form-control mt-3" name='mobile_number' placeholder="Mobile No"
                        value="{{old('mobile_number')}}" required></input>
                    <input type="submit" name='submit' class="btn btn-primary col-4 offset-4 mt-5 mb-5"></input>
                    <a href="/" class="login_anchor">Login</a>
            </form>
            <div>
                <div>
</body>

</html>