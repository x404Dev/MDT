{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
</html> --}}

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>LSPD MDT</title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="{{asset("assets/bootstrap/css/bootstrap.min.css")}}">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset("assets/fonts/fontawesome5-overrides.min.css")}}">
    @yield('styles')
    <style>
        @font-face {
            font-family: BellSlimMedium;
            src: url('assets/fonts/BellSlimBold.otf');
        }

        body {
            height: 100vh !important;
            overflow: hidden;
        }

        .hoveru:hover {
            text-decoration: underline !important;
        }

        .blue-btn {
            border-radius: 50px;
            border: 2px #006aff solid;
            color: #006aff;
            transition: 0.3s;
            padding: 2px 15px;
            background-color: transparent;
            margin: 2px;
        }

        .blue-btn:hover {
            background-color: #006aff;
            color: #fff;
        }

        .blue-btn.disabled {
            border-radius: 50px;
            background-color: #fff !important;
            border: 2px #006aff solid !important;
            color: #006aff !important;
        }


        .grey-btn {
            border-radius: 50px;
            border: 2px #262626 solid;
            color: #262626;
            transition: 0.3s;
            padding: 2px 15px;
            margin: 2px;
        }

        .grey-btn:hover {
            background-color: #262626;
            color: #fff;
        }

        .white-btn {
            border-radius: 50px;
            border: 2px #fff solid;
            color: #fff;
        }

        .white-btn:hover {
            background-color: #fff;
            color: #006aff;
        }

        .dossier-input {
            border-radius: 50px;
            padding: 5px 15px;
            border: 2px #4287f5 solid;
            width: 100%;
        }

        .dossier-input-red {
            border-radius: 50px;
            padding: 5px 15px;
            border: 2px #006aff solid;
            width: 100%;
        }

        .invalid-input {
            border-radius: 50px;
            padding: 5px 15px;
            border: 3px #006aff solid !important;
            width: 100%;
        }

        .profile-pic {
            max-width: 275px;
            height: 315px;
        }

        textarea.dossier-input {
            padding: 10px 15px;
            height: 300px;
            border-radius: 30px;
            overflow: scroll;
            resize: none;
        }

        .save-btn {
            border-radius: 50px;
            padding: 5px 15px;
            border: 2px #006aff solid;
            color: #006aff;
        }

        .save-btn:hover {
            background-color: #006aff;
            color: #fff;
        }

        .save-btn-sm {
            border-radius: 50px;
            padding: 5px 15px;
            border: 2px #006aff solid;
            color: #006aff;
            font-size: 11px;
        }

        .save-btn-sm:hover {
            background-color: #006aff;
            color: #fff;
        }

        .item-box {
            background-color: #262626;
        }

        .item-box:hover {
            background-color: #262626e7 !important;
        }

        input[type='text'] {
            font-family: BellSlimMedium, sans-serif;
        }

        textarea {
            font-family: BellSlimMedium, sans-serif;
        }

        #content-wrapper {
            background-color: #e0e0e0 !important;
        }

        .table {
            background-color: #fff;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion p-0"
            style="background-color: #262626;">
            <div class="container-fluid d-flex flex-column p-0" style="margin-top: 60px;">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <img src="{{asset("/assets/img/logo.png")}}" style="width:60%"> </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light pt-5" id="accordionSidebar" style="margin-top: 100px">
                    <li class="nav-item"><a class="nav-link" style="padding: 1.2rem 3rem !important" href="/"><i
                                class="fas fa-home"></i><span>Accueil</span></a></li>
                    <li class="nav-item"><a class="nav-link" style="padding: 1.2rem 3rem !important" href="/dossiers"><i
                                class="fas fa-user"></i><span>Dossiers</span></a></li>
                    <li class="nav-item"><a class="nav-link" style="padding: 1.2rem 3rem !important" href="/mandats"><i class="fas fa-hand-paper"></i><span>Mandats</span></a></li>
                    <li class="nav-item"><a class="nav-link" style="padding: 1.2rem 3rem !important" href="/bolo"><i class="fas fa-binoculars"></i><span>BOLO</span></a></li>
                    @if (auth()->user()->role_id == 1)
                        <li class="nav-item"><a class="nav-link" style="padding: 1.2rem 3rem !important"
                                href=""><i class="fas fa-cogs"></i><span>
                                    Utilisateurs</span></a></li>
                        <li class="nav-item"><a class="nav-link" style="padding: 1.2rem 3rem !important"
                                href="{{ route('charges.index') }}"><i class="fas fa-cogs"></i><span>
                                    Charges</span></a></li>

                    @endif
                    <li class="nav-item"><a class="nav-link" style="padding: 1.2rem 3rem !important"
                            href="{{ route('logout') }}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            </i><span>Logout</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-dark navbar-expand shadow mb-4 topbar static-top"
                    style="background-color: #006aff;">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3"
                            id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                    </div>
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span><i class="far fa-user-circle"></i> {{ Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </nav>
                <div class="container-fluid px-5 py-3">
                    @include('inc.messages')
                    @yield("content")
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset("assets/js/item.js")}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="{{asset("assets/js/bs-init.js")}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="{{asset("assets/js/theme.js")}}"></script>
</body>

</html>
