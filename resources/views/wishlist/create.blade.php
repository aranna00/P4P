@extends("layouts.app")

@section("content")
    <div class="container mt-5">
        <div class="card">
            <div class="card-header primary-color-darken white-text">
                Favorietenlijst aanmaken
            </div>
            <div class="admin-panel">
                <div class="col-md-12">
                    <div class="card-block pt-0">
                        <form class="mt-3" action="{{ action("WishlistController@store") }}" method="post">
                            {!! csrf_field() !!}
                            <div class="md-form">
                                <input type="text" id="name" name="name" value="" class="form-control">
                                <label for="name" class="control-label">Lijst naam</label>
                            </div>
                            <button class="btn btn-primary" value="Opslaan">Opslaan</button>
                            <a class="btn btn-danger" href="{{ action("WishlistController@index") }}">Annuleren</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection