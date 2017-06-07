@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-block">
                    <h1 class="text-center mb-3 mt-3">Inloggen</h1>
                    <form class="md-form" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="col-md-8 offset-md-2">
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
                                    <input type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">onthoud mij</label>
                                </div>
                            </div>

                            <div class="md-form text-center mb-0">
                                <button type="submit" class="btn btn-primary w-100 mx-0">
                                    inloggen
                                </button>
                            </div>
                            <div class="md-form text-center">
                                <a class="" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
