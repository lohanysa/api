<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="../img/icon_pestaña.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Estanteria</title>
    <style>
        .navbar,
        .btn {
            background-color: #751603 !important;
        }


        .fondo-compartido {
            min-height: 100vh;
            background: linear-gradient(rgba(5, 7, 12, 0.75), rgba(5, 7, 12, 0.75)),
                url('../img/fondo_index.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            color: black;

        }

        .navbar {
            width: 100%;
        }

        .card {
            background-color: gainsboro;
        }
    </style>
</head>

<body class="fondo-compartido">
    @include('nav')

    <div class="container mt-3">

        @if(session('mensaje'))
        <div class="row">
            <div class="alert alert-success" role="alert">
                {{ session('mensaje') }}
            </div>
        </div>
        @endif

        @if(isset($books) && count($books) > 0)
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
                            <a href="{{ route('google.show', ['google' => $book['id'] ]) }}" class="text-white">leer</a>
                        </button>

                        <!-- Botón para abrir el modal de eliminación -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal" data-volid="{{ $book['id'] }}">
                            Quitar de mi estantería
                        </button>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="alert alert-warning" role="alert">
            No hay libros en tu estantería.
        </div>
        @endif
    </div>

    <!-- Modal para confirmar eliminación -->
    <div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres eliminar este libro de tu estantería?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="eliminarForm" method="POST" action="{{ route('libro.eliminar', ['volId' => ':volId']) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <script>
        // Script para pasar el volId al formulario de eliminación
        var eliminarModal = document.getElementById('eliminarModal')
        eliminarModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var volId = button.getAttribute('data-volid')
            var form = document.getElementById('eliminarForm')
            form.action = form.action.replace(':volId', volId)
        })
    </script>
</body>

</html>