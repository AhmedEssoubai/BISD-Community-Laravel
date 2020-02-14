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
    <!--<link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">-->
    <script defer src="{{ asset('fontawesome/js/all.js') }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}" type="text/javascript"></script>
    <!--<script src="https://kit.fontawesome.com/666d79cf59.js" crossorigin="anonymous"></script>-->
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container d-flex">
                <a href="{{ route('welcome') }}" class="navbar-brand d-flex">
                    <img src="{{ asset('img/logo.png') }}" class="img-fluid" width="160px" />
                </a>
                <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>-->

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @auth
                    <form class="flex-grow-1 mx-4" method="GET" action="{{ route('search') }}">
                        @csrf
    
                        <div class="input-group md-form form-sm form-2 bg-light">
                            <input name="value" class="form-control my-0 py-1" type="search" placeholder="Chercher un groupe" aria-label="Search" aria-describedby="searchIcon" value="{{ $value ?? '' }}">
                            <input type="submit" id="searchButton" value="" class="input-group-append"/>
                            <div class="input-group-prepend" id="searchIcon">
                                <label for="searchButton" class="input-group-text">
                                    <i class="fas fa-search text-grey"
                                    aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                    </form>
                    @endauth
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="btn btn-os navbar-btn mr-2" href="{{ route('login') }}">Se connecter</a>
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
                            <a href="{{ route('groupes.list') }}" class="nav-link">Groupes</a>
                        </li>
                        @if (Auth::user()->is_admin())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administration</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.users.pending') }}">Utilisateurs</a>
                                <a class="dropdown-item" href="{{ route('admin.groupes.all') }}">Groupes</a>
                            </div>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <img src="{{ Auth::user()->image }}" id="dml_profil" class="img-fluid rounded-circle dropdown-toggle" role="button" width="50px" style="min-width:50px" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" />
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dml_profil">
                                <a class="dropdown-item" href="/profils/{{ Auth::id() }}">Profil</a>
                                <a class="dropdown-item" href="/bookmarks/{{ Auth::id() }}">Signets</a>
                                <a class="dropdown-item" href="/parametres/profil">Paramètres</a>
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
                            <a class="_link" href="{{ route('about') }}">A propos</a>
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