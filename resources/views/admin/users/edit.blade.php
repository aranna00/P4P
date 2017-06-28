@extends("admin.layouts.app")

@section("breadcrumbs")
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="fa fa-home"></i>
            <a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ action("Admin\UserController@index") }}">Gebruikers</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="">{{ $user->first_name }} {{ $user->last_name }}</a>
        </li>
    </ol>
@endsection

@section("content")
    <div class="container-fluid">
        <div class="card">
            <div class="card-header primary-color text-center white-text">
                Gebruiker bewerken: {{ $user->first_name . " " . $user->last_name }}
            </div>
            <div class="admin-panel m-3">
                <form action="{{ action("Admin\UserController@update",["user"=>$user->id]) }}" method="post">
                    {!! csrf_field() !!}
                    {!! method_field("put") !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="md-form">
                                <input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}" class="form-control">
                                <label for="first_name" class="control-label">Voornaam</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="md-form">
                                <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}" class="form-control">
                                <label for="last_name" class="control-label">Achternaam</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form">
                                <input type="text" id="name" name="email" value="{{ $user->email }}" class="form-control">
                                <label for="name" class="control-label">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form">
                                <fieldset class="form-group">
                                    <input type="checkbox" id="checkbox1" name="generate_new_password">
                                    <label for="checkbox1">Genereer nieuw wachtwoord voor deze gebruiker (deze wordt naar de gebruiker gemaild)</label>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary" value="Opslaan">Opslaan</button>
                            <a class="btn btn-secondary"
                               href="{{ action("Admin\UserController@index") }}">Annuleren</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.mdb-select').material_select();
    </script>
@endsection