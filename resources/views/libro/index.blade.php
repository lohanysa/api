<!doctype html>
<html lang="es">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta charset="utf-8">
    <link rel="icon" href="../img/icon_pestaña.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<style>
        .navbar,
        .btn {
            background-color: #751603  !important;
        }


        .fondo-compartido {
            min-height: 100vh;
            background: linear-gradient(rgba(5, 7, 12, 0.75), rgba(5, 7, 12, 0.75)),
                url('../img/fondo_index.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;

        }

        .navbar {
            width: 100%;
        }

        .card{
            background-color:gainsboro;
        }
    </style>
</head>

<body class="fondo-compartido">

@include('nav');

    <div class="container mt-3">
        <div class="mb-3 mt-3">
            <form method="get" action="{{ route('buscar_libro') }}">
                <label for="query" class="form-label text-light fw-bold ">Buscar libro</label>
                <div class="small-container">
                    <input type="text" class="form-control" name="query" id="query" aria-describedby="helpId" />
                </div>
                <small id="helpId" class="form-text text-light text-muted">Ingrese el nombre del libro sin caracteres especiales</small>
                <br>
                <button type="submit" class="btn btn-primary mt-2">Buscar</button>
            </form>
        </div>

        @if(session('mensaje'))
        <div class="alert alert-danger">
            {{ session('mensaje') }}
        </div>
        @endif

        @if(isset($books) && count($books) > 0)

        <h2 class="text-light">Resultados de la búsqueda para "{{ request()->query('query') }}"</h2>

        <div class="row">
            @foreach($books as $book)
            <div class="col-md-3 mb-4"> <!-- Cada tarjeta será una columna -->
                <div class="card" style="width: 18rem;">
                    @if(isset($book['volumeInfo']['imageLinks']['thumbnail']))
                    <img src="{{ $book['volumeInfo']['imageLinks']['thumbnail'] }}" class="card-img-top" alt="Imagen de {{ $book['volumeInfo']['title'] }}" />
                    @else
                    <img src="https://cdn.pixabay.com/photo/2019/11/19/22/24/watch-4638673_1280.jpg" class="card-img-top" alt="Imagen no disponible" />
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $book['volumeInfo']['title'] }}</h5>

                        <p class="card-text">
                            {{ isset($book['volumeInfo']['description']) ? Str::limit($book['volumeInfo']['description'], 150) : 'Sin descripción disponible' }}
                        </p>

                        @if(isset($book['volumeInfo']['authors']))
                        <p class="card-text"><small class="text-muted">Autor(es): {{ implode(', ', $book['volumeInfo']['authors']) }}</small></p>
                        @else
                        <p class="card-text"><small class="text-muted">Autor desconocido</small></p>
                        @endif

                        <input value="{{$book['id']}}" id='volId' hidden>

                        <button type="button" class="btn btn-dark">
                            <a href="{{ route('google.show', ['google' => $book['id'] ]) }}" class="text-white">Ver</a>
                        </button>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>