<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- includes the Braintree JS client SDK -->
    <script src="https://js.braintreegateway.com/web/dropin/1.32.0/js/dropin.min.js"></script>

    <!-- includes jQuery -->
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark my_navbar shadow-sm">
            <div class="container">
                <div class="my_logo mx-2">
                    <img src="{{asset('images/logo.png')}}" alt="">
                </div>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{-- start Content-page --}}
        <div class="container-fluid"> 
            <div class="row flex-nowrap">

                <!-- start SIDEBAR -->
                @auth
                    <div class="col-auto col-md-3 col-xl-2 px-0 my_sidebar">
                        <div class="d-flex align-items-center justify-content-center my_dashboard">
                            <span class="d-none d-sm-inline py-3">Dashboard</span>
                        </div>
                        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 my_menu min-vh-100">
                            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                                <li>  
                                    <a href="{{route('admin.users.index')}}" class="nav-link align-middle px-0 ">
                                        <i class="bi bi-person-circle" style="font-size:1.1rem;"></i>
                                        <h6 class="ms-2 d-none d-sm-inline">Profilo</h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.message_page')}}" class="nav-link align-middle px-0 ">
                                        <i class="bi bi-chat-dots-fill" style="font-size:1.1rem"></i>
                                        <h6 class="ms-2 d-none d-sm-inline">Messaggi ricevuti</h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.review_page')}}" class="nav-link px-0 align-middle">
                                        <i class="bi bi-pencil" style="font-size:1.1rem"></i>
                                        <h6 class="ms-1 d-none d-sm-inline">Recensioni ricevute</h6> 
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.sponsor.index')}}" class="nav-link px-0 align-middle">
                                        <i class="bi bi-star-fill" style="font-size:1.1rem"></i> 
                                        <h6 class="ms-2 d-none d-sm-inline">Sponsorizzazione</h6>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.index')}}" class="nav-link px-0 align-middle">
                                        <i class="bi bi-bar-chart-line-fill" style="font-size:1.1rem"></i>
                                        <h6 class="ms-2 d-none d-sm-inline">Statistiche</h6>
                                    </a>
                                </li>
                            </ul>
                            <hr>
                            
                        </div>
                    </div>
                              
                @endauth
                <!-- end SIDEBAR -->

                <div class="col py-4">
                    <main>
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
        {{-- end Content-page --}}
    </div>

     <!-- JavaScript Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>
