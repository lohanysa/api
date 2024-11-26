<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="../img/icon_pestaña.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Iniciar Sesión</title>
    <style>
        .fondo-compartido {
            min-height: 100vh;
            background: linear-gradient(rgba(5, 7, 12, 0.75), rgba(5, 7, 12, 0.75)),
                url('../img/login.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-label {
            color: #fff;
            font-weight: bold;
        }

        .form-control {
            border-radius: 25px;
        }

        .btn-primary {
            background-color: gray;
            border-color: gray;
        }

        .btn-primary:hover {
            background-color: darkgray;
            border-color: darkgray;
        }
    </style>
</head>

<body class="fondo-compartido">

    <div>
        <h1 class="text-light">Iniciar sesión</h1>
        <form method="post" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" aria-describedby="correoHelp" required>
                <div id="correoHelp" class="form-text"></div>
                @if ($errors->has('correo'))
                <div class="text-danger">{{ $errors->first('correo') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" name="pass" id="pass" aria-describedby="passwordHelp" required>
                <div id="passwordHelp" class="form-text"></div>
                @if ($errors->has('pass'))
                <div class="text-danger">{{ $errors->first('pass') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>
