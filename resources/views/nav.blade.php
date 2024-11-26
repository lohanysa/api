<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="bi bi-book-half"></i> LibrosMania </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('buscar_libro') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('estantePrivado') }}">Estanteria</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('salir') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" tabindex="-1">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        <span class="nav-link">
                            <i class="bi bi-person-check-fill"></i> {{ auth()->user()->nombre}}
                        </span>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
