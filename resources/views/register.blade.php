<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Register</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body> 
        <div>
            @if($errors)
                @foreach ($errors->all() as $error)
                  <div>{{ $error }}</div>
                @endforeach
            @endif
        </div>
        <center>
            <form action="/registerme" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                Name: <input type="text" name="name"></br>
                Email: <input type="email" name="email"></br>
                Password: <input type="password" name="password"></br>
                <input type="submit" name="register" value="Register">
            </form>
        </center>
    </body>
</html>
