@extends('layouts.app')

@section('content')
    <div class="container-fluid p-3 mt-4">
        <div class="row">
            @foreach ($wishlists as $wishlist)
                <div class="col col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-2">
                    <div class="card">
                        <div class="card-block">

                            <i class="fa fa-fixed fa-2x fa-times text-grey hover-red float-right" onclick="if (confirm('Weet u zeker dat u deze lijst wilt verwijderen?')){ {$('#delete{{ $wishlist->id }}').submit();} }"></i>
                            <h4 class="card-title">{{ $wishlist->name }}</h4>

                            <p class="card-text">Aantal producten in lijst: {{ $wishlist->products()->count() }}</p>

                            <form id="delete{{ $wishlist->id }}" action="{{ action("WishlistController@destroy", ["wishlist"=>$wishlist->id]) }}" method="post">
                                {!! csrf_field() !!}
                                <a href="{{ action("WishlistController@edit", $wishlist->id) }}" class="btn btn-primary ml-0">Bekijk deze lijst</a>
                                {!! method_field("delete") !!}
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Lelijk responsive, needs fix -->
        <a class="btn-floating btn-large secondary-color" style="position: fixed; bottom: 220px; right: 24px;"
           href="{{ action("WishlistController@create") }}">
            <i class="fa"><b>+</b></i>
        </a>
    </div>
@endsection
