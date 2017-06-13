@extends("layouts.app")

@section("content")
    <div class="col-md-12 mt-5">
        <div class="card">
            <div class="card-header primary-color white-text">
                {{ $wishlist->name }}
            </div>
            <div>
                <div class="col-md-12">
                    <div class="card-block pt-0">
                        <form class="mt-3"
                              action="{{ action("WishlistController@update",["wishlist"=>$wishlist->id]) }}"
                              method="post">
                            {!! csrf_field() !!}
                            {!! method_field("put") !!}
                            <div class="md-form">
                                <input type="text" id="name" name="name" value="{{ $wishlist->name }}"
                                       class="form-control">
                                <label for="name" class="control-label">Lijst naam</label>
                            </div>
                            <button class="btn btn-primary" value="Opslaan">Opslaan</button>
                            <a class="btn btn-secondary"
                               href="{{ action("WishlistController@index") }}">Annuleren</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header primary-color white-text">
                Producten in deze lijst
            </div>
            <div>
                <div class="col-md-12">
                    <div class="card-block pt-0">
                        <form class="mt-3"
                              action="{{ action("WishlistController@update",["wishlist"=>$wishlist->id]) }}"
                              method="post">
                            {!! csrf_field() !!}
                            <div class="md-form">
                                @if (count($wishlist->products) > 0)
                                    <ul class="list-group">
                                        @foreach ($wishlist->products as $product)
                                            <li class="list-group-item">{{ $product->name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    Deze lijst bevat geen producten
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection