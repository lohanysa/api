<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="../img/icon_pestaña.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Bienvenido</title>
    <style>
        .fondo-compartido {
            min-height: 100vh;
            background: url('../img/bienvenidos.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            color: black;
            text-align: center;
        }

        .btn-custom {
            border-radius: 50px; /* Bordes redondeados */
            padding: 10px 20px; /* Ajuste del tamaño */
            margin: 10px; /* Separación entre botones */
            width: 300px; /* Ancho fijo para los botones */
        }

        .btn-login {
            background-color: #6c757d; /* Gris claro */
        }

        .btn-register {
            background-color: #495057; /* Gris más oscuro */
        }

        .btn a {
            color: white;
            text-decoration: none;
        }

        .col {
            display: flex;
            flex-direction: column;
            justify-content: center; /* Centra los botones verticalmente */
            align-items: center; /* Centra los botones horizontalmente */
            text-align: center;
        }

        .row {
            margin-bottom: 15px;
        }
    </style>
</head>

<body class="fondo-compartido">
    <div class="col">
        <div class="row">
            <button type="button" class="btn btn-register btn-custom">
                <a href="{{ route('user.create') }}">Registrarse</a>
            </button>
        </div>

        <div class="row">
            <button type="button" class="btn btn-login btn-custom">
                <a href="{{ route('user.index') }}">Iniciar sesión</a>
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>

