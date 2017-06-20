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
    </ol>
@endsection

@section("content")
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header primary-color text-center white-text">
                    Alle Gebruikers
                </div>
                <div class="admin-panel info-admin-panel">
                    <div class="col-md-12">
                        <div class="card-block pt-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Naam</th>
                                        <th>Email</th>
                                        <th>Bedrijf</th>
                                        <th>Laatst ingelogd</th>
                                        <th>Acties</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                {{ $user->first_name . " " . $user->last_name }}
                                            </td>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                {{ $user->business->bestaandehandelsnaam }}
                                            </td>
                                            <td>
                                                {{ $user->last_login }}
                                            </td>
                                            <td>
                                                <form id="delete{{ $user->id }}" action="{{ action("Admin\UserController@destroy", ["user"=>$user->id]) }}" method="post">
                                                    {!! csrf_field() !!}
                                                    {!! method_field("delete") !!}
                                                    <a class="btn btn-primary"
                                                       href="{{ action("Admin\UserController@edit",["user"=>$user->id]) }}">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a class="btn btn-danger" onclick="if (confirm('Weet u het zeker')){ {$('#delete{{ $user->id }}').submit();} }"><i class="fa fa-times"></i></a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! $users->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a class="btn-floating btn-large secondary-color" style="position: fixed; bottom: 45px; right: 24px;"
           href="{{ action("Admin\UserController@create") }}">
            <i class="fa"><b>+</b></i>
        </a>
    </div>
@endsection