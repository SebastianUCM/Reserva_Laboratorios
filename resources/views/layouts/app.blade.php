<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
        <style>
           .bg 
            {
                background: url('/image/blanco.jpg');
                height: 100%;
                width: 100%;
                padding-right: auto;
                padding-left: auto;
                margin-right: auto;
                margin-left: auto;
            }
        </style>
<div class="bg">
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar navbar-dark bg-primary shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Lado izquierdo de la barra de navegación -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Lado derecho de la barra de navegación -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Autentificacion -->
                            @guest
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                    <!--    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a> -->
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                                </li>

                            @else
                                
                                <li class="nav-item dropdown">
                                    <!-- Calendario -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="/agenda">{{ __('Calendario') }}</a>
                                    </li>
                                    <!-- Lista de reservas -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="/Reservas">{{ __('Lista de Reservas') }}</a>
                                    </li>
                                   @if(Auth::user()->rol == 'Secretario/a' or Auth::user()->rol == 'Encargado/a'or Auth::user()->rol == 'Administrador')
                                    <!--  Usuarios -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="/Usuarios">{{ __('Usuarios') }}</a>
                                    </li>
                                     @endif
                                    <!-- Laboratorios -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="/Laboratorios">{{ __('Laboratorios') }}</a>
                                    </li>
                                    
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Cerrar Sesión') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
</div>
</html>
