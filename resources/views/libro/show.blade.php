<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <link href="../../css/style.css">
    <title>Libro - Vista Previa</title>
    <style>
        .navbar,
        .btn {
            background-color: saddlebrown !important;
        }


        .fondo-compartido {
            min-height: 100vh;
            background: linear-gradient(rgba(5, 7, 12, 0.75), rgba(5, 7, 12, 0.75)),
                url('../img/fondo_index.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            color: whitesmoke;

        }

        .navbar {
            width: 100%;
        }

        .card {
            background-color: saddlebrown;
        }
    </style>
</head>

<body class="fondo-compartido">
    @include('nav')

    <div class="container">
        <div class="row mt-3">

            <div class="col-md">
                @if(isset($book['volumeInfo']))
                <div id="volume-main">
                    <div id="volume-left">
                        <h1> {{ $book['volumeInfo']['title'] ?? 'Título no disponible' }} </h1>
                        <p> Autor: {{ isset($book['volumeInfo']['authors']) ? implode(', ', $book['volumeInfo']['authors']) : 'Autor no disponible' }} </p>
                        <p> {{ $book['volumeInfo']['description'] ?? 'Descripción no disponible' }} </p>
                    </div>
                </div>
                @else
                <p>Información del libro no disponible.</p>
                @endif

                <div class="btn-group" role="group" aria-label="Basic example">
                    <form action="{{ route('crudLibro.store') }}" method="post">
                        @csrf
                        <input name="volId" value="{{ $book['id'] }}" hidden>
                        <button type="submit" class="btn btn-dark">Agregar a librería</button>
                    </form>

                    <button type="button" class="btn btn-dark">
                        <a href="{{ $book['volumeInfo']['previewLink'] }}" class="link-light">Leer</a>
                    </button>
                </div>
            </div>

            <div class="col-md">
                <div class="card" style="width: 18rem;">
                    <img src="{{ $book['volumeInfo']['imageLinks']['thumbnail'] }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Portada del libro</p>
                    </div>
                </div>
            </div>
        </div>

        @if(session('mensaje'))
        <div class="row">
            <div class="alert alert-success" role="alert">
                {{ session('mensaje') }}
            </div>
        </div>
        @endif
    </div>

</body>

</html>