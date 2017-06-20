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
        <button class="btn btn-floating btn-large primary-color" style="position: fixed; bottom: 220px; right: 24px;"
           onclick="$('#createWishlist').modal('show')">
            <i class="fa py-1"><h4 class="font-weight-bold">+</h4></i>
        </button>
    </div>


    <!--Modal: Subscription From-->
    <div class="modal fade" id="createWishlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
            <!--Content-->
            <div class="modal-content">

                <!--Header-->
                <div class="modal-header primary-color-darken white-text">
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="title">Favorietenlijst maken</h4>
                </div>
                <!--Body-->
                <div class="modal-body mb-0">
                    <form action="{{ action("WishlistController@store") }}" method="post">
                        {!! csrf_field() !!}
                        <div class="md-form form-sm">
                            <input type="text" id="name" class="form-control" name="name"
                                   value="">
                            <label for="name">Lijstnaam</label>
                        </div>

                        <div class="text-center mt-1-half">
                            <button class="btn btn-primary mb-1">Aanmaken <i class="fa fa-check ml-1"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!--Modal: Subscription From-->
@endsection
