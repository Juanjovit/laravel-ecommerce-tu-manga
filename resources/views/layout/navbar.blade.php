<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - TuManga</title>
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
    <script src="js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    
    <nav class="navbar d-block navBackgroundColor desktopNavbarSize fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="desktopNavbarDisplay pe-5">
                <a class="navbar-brand ps-5 comicFont" href="{{ route('home') }}">TuManga</a>
                <ul class="navbar-nav ps-3 d-none d-lg-block">
                    <li>
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('shop') }}">Shop</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('series') }}">Ver por serie</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('noticias') }}">Noticias</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('carrito.index') }}">Carrito</a>
                    </li>
                    @auth
                        <li class="nav-item mt-5">
                           Sesion iniciada como: <strong>{{ auth()->user()->email }}</strong>
                           <form action="{{ route('auth.processLogout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn nav-link">-Cerrar Sesión-</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item mt-5">
                            <a class="nav-link" href="{{ route('auth.formLogin') }}">-Iniciar Sesión-</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.formRegister') }}">Registrarse</a>
                        </li>
                    @endauth
                    @auth
                        @if(auth()->check() && auth()->user()->user_role === 0)
                            <li>
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a>
                                <a class="nav-link" href="{{ route('perfil', ['id' => auth()->user()->user_id]) }}">Perfil</a>
                            </li>
                        @else
                            <li>
                                <a class="nav-link" href="{{ route('perfil', ['id' => auth()->user()->user_id]) }}">Perfil</a>
                            </li>
                        @endif
                    @endauth

                </ul>
            </div>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <p  id="offcanvasNavbarLabel">TuManga</p>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li>
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('shop') }}">Shop</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('series') }}">Ver por serie</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('noticias') }}">Noticias</a>
                        </li>
                        @auth
                            <li class="nav-item mt-5">
                            Sesion iniciada como: <strong>{{ auth()->user()->email }}</strong>
                            <form action="{{ route('auth.processLogout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn nav-link">-Cerrar Sesión-</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item mt-5">
                                <a class="nav-link" href="{{ route('auth.formLogin') }}">-Iniciar Sesión-</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('auth.formRegister') }}">Registrarse</a>
                            </li>
                        @endauth
                        @auth
                            @if(auth()->check() && auth()->user()->user_role === 0)
                                <li>
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a>
                                    <a class="nav-link" href="{{ route('perfil', ['id' => auth()->user()->user_id]) }}">Perfil</a>
                                </li>
                            @else
                                <li>
                                    <a class="nav-link" href="{{ route('perfil', ['id' => auth()->user()->user_id]) }}">Perfil</a>
                                </li>
                            @endif
                        @endauth
             
                        
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="content mt-5 mt-lg-0">




        @if(Session::has('status.message'))        
            <div class="notificationModal">{!! Session::get('status.message') !!}</div>
        @endif

        @yield('main')

    </div>

    <div class="footer">

    </div>


  
</body>
</html>
