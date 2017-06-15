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
            <strong>Navbar</strong>
        </a>
        <div class="collapse navbar-collapse" id="navbarNav1">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(Route::current()->getName() == 'home') active @endif">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item @if(Route::current()->getName() == 'product' || Route::current()->getName() == 'filtered') active @endif">
                    <a href="{{ route('product') }}" class="nav-link">Producten</a>
                </li>
                <li class="nav-item @if(str_contains(Route::current()->getName(), 'favorieten')) active @endif">
                    <a href="{{ route('favorieten.index') }}" class="nav-link">Favorieten</a>
                </li>
            </ul>
            <form class="form-inline waves-effect waves-light">
                <input class="form-control" type="text" placeholder="Search">
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item @if(Route::current()->getName() == 'winkelwagen') active @endif">
                    <a href="{{ route('winkelwagen.index') }}" class="nav-link">Winkelwagen</a>
                </li>
                <!-- Authentication Links -->
                @if (Sentinel::guest())
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    {{--<li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>--}}
                @else
                    <li class="nav-item dropdown btn-group">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            {{ Sentinel::check()->first_name }} {{ Sentinel::check()->last_name }} <span
                                    class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown" role="menu">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                                Logout
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

            <!--First column-->
            <div class="col-md-6">
                <h5 class="title">Footer Content</h5>
                <p>Here you can use rows and columns here to organize your footer content.</p>
            </div>
            <!--/.First column-->

            <!--Second column-->
            <div class="col-md-6">
                <h5 class="title">Links</h5>
                <ul>
                    <li><a href="#!">Link 1</a></li>
                    <li><a href="#!">Link 2</a></li>
                    <li><a href="#!">Link 3</a></li>
                    <li><a href="#!">Link 4</a></li>
                </ul>
            </div>
            <!--/.Second column-->
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
@yield('scripts')
</body>
</html>
