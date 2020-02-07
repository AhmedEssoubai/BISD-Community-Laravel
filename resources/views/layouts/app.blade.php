<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-accueil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-groupe.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-profil.css') }}">
    <script src="https://kit.fontawesome.com/666d79cf59.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a href="{{ route('welcome') }}" class="navbar-brand d-flex">
                    <img src="{{ asset('img/logo.png') }}" class="img-fluid" width="160px" />
                </a>

                <!--
                <form class="w-50 mw-100 mx-auto" method="GET" action="#">
                    <div class="input-group md-form form-sm form-2 bg-light">
                        <input class="form-control my-0 py-1" type="search" placeholder="Chercher un groupe" aria-label="Search" aria-describedby="searchIcon">
                        <input type="submit" id="searchButton" value="" class="input-group-append"/>
                        <div class="input-group-prepend" id="searchIcon">
                            <label for="searchButton" class="input-group-text">
                                <i class="fas fa-search text-grey"
                                aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                </form>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>-->

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="btn btn-outline-secondary navbar-btn mr-2" href="{{ route('login') }}">Se connecter</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="btn btn-primary navbar-btn" href="{{ route('register') }}">S'inscrire</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('groupes.create') }}" class="nav-link">Groupes</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Utilisateurs</a>
                        </li>
                        <li class="nav-item dropdown">
                            <img src="{{ asset('img/default.png') }}" id="dml_profil" class="img-fluid border border-secondary rounded-circle dropdown-toggle" role="button" width="50px" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" />
                            <!--<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>-->

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dml_profil">
                                <a class="dropdown-item" href="#">Profil</a>
                                <a class="dropdown-item" href="#">Signets</a>
                                <a class="dropdown-item" href="#">Paramètres</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Se déconnecter
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

        <main>
            @yield('content')
        </main>

        <footer>
            <div class="border-top border-bottom bg-light">
                <div class="container">
                    <div class="row my-3">
                        <span class="lead mr-auto my-auto">
                            <a class="_link" href="apropos.html">A propos</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row my-3">
                    <img src="{{ asset('img/logo.png') }}" class="img-fluid mr-3" width="160px" />
                    <span class="lead mr-auto my-auto">
                        Copyright © 2020
                    </span>
                    <img src="{{ asset('img/ensa-tanger.png') }}" class="img-fluid" width="80px" />
                </div>
            </div>
            <div class="bar"></div>
        </footer>
    </div>
</body>

</html>