<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}} - Login </title>
    <link rel="stylesheet" href="{{ asset('backend/style.css') }}">
</head>

<body>

    <div class="login-box">
        <form method="POST" action="{{ route('AdminLogin.Post') }}">
            @csrf
            <div class="user-box">
                <input type="text" name="email" required="" autofocus>
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <button type="submit">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Submit
            </button>
        </form>
    </div>
    </div>
    </div>


</body>

</html>