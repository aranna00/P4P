<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inloggen</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdb.css') }}" rel="stylesheet">

</head>
<body id="Login_Body">
    <div class="container vertical-center">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-block">
                    <div class="row justify-content-center mb-5 mt-3">
	                    <img src="{{ asset('img/jansma_logo.png') }}" class="img-fluid">
                    </div>
	
	                <form class="md-form" role="form" method="POST" action="{{ action("Auth\LoginController@login") }}">
                        {{ csrf_field() }}
                        <div class="col-md-10 offset-md-1">
                            <div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">

                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" required>
                                <label for="email" class="">Emailadres</label>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="red-text">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" required>
                                <label for="password" class="">Wachtwoord</label>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="red-text">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="md-form">
                                <div class="checkbox">
	                                <input type="checkbox" id="remember"
	                                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">Onthoud mij</label>
                                </div>
                            </div>

                            <div class="md-form text-center mb-0">
                                <button type="submit" class="btn btn-primary w-100 mx-0">
                                    inloggen
                                </button>
                            </div>
                            <div class="md-form text-center">
	                            {{--                                <a class="" href="{{ route('password.request') }}">--}}
	                            {{--wachtwoord vergeten?--}}
	                            {{--</a>--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/mdb.min.js') }}"></script>
</body>
</html>
