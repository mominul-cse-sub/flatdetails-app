<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/flat.scss', 'resources/js/app.js'])

    <script src="/js/flat.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@{{ version }}/dist/js/bootstrap.bundle.min.js"></script> --}}





</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top topNavbar">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto leftNav offset-2">
                        <li>
                            <a href=""><i class="fa-solid fa-bars"></i></a>
                        </li>
                        <li>
                            <a href="">About</a>
                        </li>
                        <li>
                            <a href="">Support</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto rightNav">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown ">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-bell fa-lg"></i>
                                </a>

                                <div class="dropdown-menu profileInfoContainer dropdown-menu-end"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-user fa-lg"></i>
                                </a>

                                <div class="dropdown-menu profileInfoContainer dropdown-menu-end"
                                    aria-labelledby="navbarDropdown">
                                    <div class="card text-center">
                                        <img src="{{ Auth::user()->avatar ? '/images/avatar.jpg' : '/images/avatar.jpg' }}"
                                            class="card-img-top rounded-circle mx-auto mt-4" alt="Profile Picture"
                                            style="width: 100px; height: 100px;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ Auth::user()->name }}</h5>
                                            <p class="card-text">Flat Owner</p>
                                            <button class="btn btn-primary">Settings</button>
                                            <a class="btn btn-danger" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                        </div>
                                    </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container-fluid">
            <div class="row">
                <div class="col-2 leftSidebar p-0">
                    <a class="navbar-brand shadow-sm" href="{{ url('/flat') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <ul>
                        <li class="">
                            <a href="/flat">
                                <i class="fa-solid fa-gauge"></i> Dashboard
                            </a>
                        </li>
                        <li onclick="openMenu(this)">
                            <a href="#">
                                <i class="fa-solid fa-table-columns"></i>
                                Flat
                                <i class="fa-solid fa-chevron-down"></i>
                            </a>
                            <ul>
                                <li class="">
                                    <a href="/flat/create">
                                        <i class="fa-solid fa-house-medical"></i>
                                        Add New
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('flat.allflat') }}">
                                        <i class="fa-solid fa-house"></i>
                                        All Flats
                                    </a>
                                </li>
                                <li class=""><a href="{{ route('flat.activeflat') }}"><i
                                            class="fa-solid fa-house-medical-circle-check"></i> Active Flats</a></li>
                                <li class=""><a href="{{ route('flat.inactiveflat') }}"><i
                                            class="fa-solid fa-house-medical-circle-exclamation"></i>Inactive Flats</a>
                                </li>
                            </ul>
                        </li>
                        <li class=""><a href="/flat/profile"><i class="fa-solid fa-user"></i>
                                Profile</a></li>
                        <li class="logout">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-power-off"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-10 mainContent py-4 offset-2">
                    <div class="alertContainer" id="alertContainerID">
                        @if (Session::has('message'))
                            <script>
                                closeAlertModal()
                            </script>
                            <div class="alert alert-dismissible alert-{{ Session::get('message')['type'] }} ">
                                {{ Session::get('message')['message'] }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>

</html>
