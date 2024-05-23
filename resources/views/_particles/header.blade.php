<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{!Auth::user() ? route('login') : route('home') }}">Oracle Test</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{!Auth::user() ? route('login') : route('home') }}">Inicio</a>
                </li>
                @if (!Auth::user())
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">Registro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('verify-user')}}">Cambiar Contraseña</a>
                    </li>
                @endif
                @auth
                    <li class="nav-item">
                        <a href={{route('employes')}} class="nav-link" href="">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('departments')}}">Departamentos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Perfil</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesion</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
