<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="row">
<div id="fb-root"></div>
<div id="app" class="col-12">
    <nav class="navbar fixed-top navbar-toggleable-md scrolling-navbar navbar-dark bg-navbar">
        {{--<div class="container">--}}
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            {{--<strong>Navbar</strong>--}}
            <img src="{{ asset('img/jansma_logo_nav.png') }}" style="height: 32px;">
        </a>
        <div class="collapse navbar-collapse" id="navbarNav1">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(Route::current()->getName() == 'home') active @endif">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item @if(Route::current()->getName() == 'producten' || Route::current()->getName() == 'filtered') active @endif">
                    <a href="{{ route('producten') }}" class="nav-link">Producten</a>
                </li>
                <li class="nav-item @if(str_contains(Route::current()->getName(), 'favorieten')) active @endif">
                    <a href="{{ route('favorieten.index') }}" class="nav-link">Favorieten</a>
                </li>
            </ul>
            <form action="/filter" method="get" class="form-inline waves-effect waves-light">
                <input class="form-control" type="text" name="search" placeholder="Search">
            </form>
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Sentinel::guest())
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    {{--<li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>--}}
                @else
                    @if(Sentinel::inRole("admin"))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ action("Admin\HomeController@index") }}">
                                Beheer
                            </a>
                        </li>
                    @endif
                    <li class="nav-item @if(Route::current()->getName() == 'winkelwagen') active @endif">
                        <a href="{{ route('winkelwagen.index') }}" class="nav-link">Winkelwagen <span class="badge green">{{ Sentinel::check()->cart()->count() }}</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link waves-effect waves-light" typeof="button" id="navbarProfle"
                           data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="true">{{ Sentinel::check()->first_name }} {{ Sentinel::check()->last_name }}
                            <span class="caret"></span></a>
                        <div class="dropdown-menu dropdown-blue dropdown-menu-right" aria-labelledby="navbarProfle"
                             data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <a class="dropdown-item" href="{{ action('OrderController@index') }}">Orders</a>
	                        <a class="dropdown-item" href="{{ action("BusinessController@index") }}">Bedrijf beheren</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
	                            Uitloggen
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
        {{--</div>--}}
    </nav>
    @yield('content')
</div>


<!--Footer-->
<footer class="page-footer bg-navbar center-on-small-only col-12 align-self-end m-0">

    <!--Footer Links-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <img src="/img/jansma_logo_nav.png" class="mb-2" style="height: 80px">
                <p><a>Algemene Voorwaarden</a> | <a>Cookies</a> | <a>Privacy</a> | <a href="{{ action("ContactController@index") }}">Contact</a></p>
            </div>
        </div>
    </div>
    <!--/.Footer Links-->

    <!--Copyright-->
    <div class="footer-copyright">
        <div class="container-fluid">
            © {{ date('Y') }} Jansma Boerenproducten

        </div>
    </div>
    <!--/.Copyright-->

</footer>
<!--/.Footer-->

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/tether.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/mdb.min.js') }}"></script>
<script src="{{ asset('js/ion.rangeSlider.js') }}"></script>
<script src="{{ asset('js/toastr.js') }}"></script>
{!! Toastr::render() !!}
@yield('scripts')
</body>
</html>
