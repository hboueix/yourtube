<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Yourtube') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/8100dbee1b.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/favicon.ico') }}"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('storage/logo_200x122.png') }}" style="width: 100px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav" style="width: 100%;">
                    <div class="mx-auto search-dropdown">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher..."
                                   aria-label="rechercher" aria-describedby="rechercher"
                                   onfocus="toggleShow()" onblur="toggleShow()" oninput="getContent()"
                                   onkeyup="handle(event)">
                            <div class="input-group-append">
                                <a class="btn btn-outline-secondary" type="button" id="rechercher"
                                   onclick="getResults()"><i
                                        class="fas fa-search"></i></a>
                            </div>
                        </div>
                        <div id='resultsDropdown' class='dropdown-content'
                             onmouseover="document.getElementById('searchInput').removeAttribute('onblur')"
                             onmouseleave="document.getElementById('searchInput').setAttribute('onblur', 'toggleShow()')">
                        </div>
                    </div>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                        </li>
                        {{--
                                                @if (Route::has('register'))
                        --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                        </li>
                        {{--
                                                @endif
                        --}}
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if(isset(Auth::user()->profile->avatar))
                                    @if(strlen(Auth::user()->profile->avatar))
                                        <img src="{{ asset('storage/' . Auth::user()->profile->avatar) }}" width="40"
                                             height="40" style="border-radius: 100%">
                                    @else
                                        <img src="https://static.asianetnews.com/img/default-user-avatar.png" width="40"
                                             height="40" style="border-radius: 100%">
                                    @endif
                                @else
                                    <img src="https://static.asianetnews.com/img/default-user-avatar.png" width="40"
                                         height="40" style="border-radius: 100%">
                                @endif {{ ucfirst(Auth::user()->name) }} <span class="caret"></span>
                            </a>


                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    Dashboard
                                </a>
                                <a class="dropdown-item" href="{{ route('profile_show', Auth::user()->name ?? '') }}">
                                    Mon profil
                                </a>
                                @if(Auth::user()->hasAnyRole(['administrateur', 'moderateur']))
                                    <a class="dropdown-item" href="{{ route('reportings') }}">
                                        Administration
                                    </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Se déconnecter') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @if(Auth::user()->hasAnyRole(['administrateur', 'moderateur']))
                            <div class="d-flex align-items-center">
                                @if($notifications === 0)
                                    <a href="{{route('reportings')}}"><span class="badge badge-success"><i
                                                class="far fa-bell mr-1"></i>{{$notifications ?? '0'}}</span>
                                    </a>
                                @else
                                    <a href="{{route('reportings')}}"><span class="badge badge-danger"><i
                                                class="far fa-bell mr-1"></i>{{$notifications ?? '0'}}</span>
                                    </a>
                                @endif
                            </div>
                        @endif

                        <a class="d-flex" href="{{ route('video_form') }}">
                            <button type="submit" class="btn btn-light">
                                <i class="fas fa-upload"></i>
                            </button>
                        </a>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
<!-- Footer -->
<hr>
<footer class="pt-4">
    <div class="d-flex justify-content-center">
        <div class="col-md-4 mt-md-0 mt-3">
            <h5 class="text-uppercase">Yourtube</h5>
            <p>Yourtube est un site web d'hébergement de vidéo en ligne français. Celui-ci est toujours en développement, nous vous
            remercions de votre compréhension.</p>
        </div>
        <div class="col-md-2 mb-md-0 mb-3">
            <h5 class="text-uppercase">Actions</h5>
            <ul class="list-unstyled">
                <li>
                    <a href="#!">S'inscrire</a>
                </li>
                <li>
                    <a href="#!">Se connecter</a>
                </li>
                <li>
                    <a href="#!">Mettre en ligne une vidéo</a>
                </li>
            </ul>
        </div>
        <div class="col-md-2 mb-md-0 mb-3">
            <h5 class="text-uppercase">Liens utiles</h5>
            <ul class="list-unstyled">
                <li>
                    <a href="#!">Nous contacter</a>
                </li>
                <li>
                    <a href="#!">CGU</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="footer-copyright text-center py-3">© 2019 - 2020 Copyright | Développé avec ❤️ par Hugo B. & Thibault F.
    </div>

</footer>
<script type="text/javascript">

    function toggleShow() {
        document.getElementById("resultsDropdown").classList.toggle("show");
    }

    function getContent() {
        const search = document.getElementById('searchInput');
        const resultsDropdown = document.getElementById('resultsDropdown');
        const searchValue = search.value;
        if (searchValue != "") {
            const xhr = new XMLHttpRequest();

            xhr.open('GET', '{{route("search")}}/?search=' + searchValue, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function () {

                if (xhr.readyState == 4 && xhr.status == 200) {
                    resultsDropdown.innerHTML = xhr.responseText;
                }
            }
            xhr.send()
        } else {
            resultsDropdown.innerHTML = "";
        }
    }

    function handle(e) {
        const searchValue = document.getElementById("searchInput").value;
        if (e.keyCode === 13 && searchValue != "") {
            event.preventDefault();
            getResults();
        }
    }

    function getResults() {
        const searchValue = document.getElementById("searchInput").value;
        if (searchValue != "") {
            const url = "{{route('results')}}/?search=" + searchValue;
            document.location.href = url;
        }
    }
</script>
</body>
</html>
