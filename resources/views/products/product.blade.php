@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card mb-2">
            <div class="row px-3">
                <div class="col-md-3 pl-3 pt-1 pr-md-0 ">
                    <img src="{{ asset("img/producten/".$product->code.".jpg") }}"
                         class="img-fluid w-100 breadcrumb-white m-0">
                    <div class="card-block pl-0">
                        <h4>Prijs</h4>
                        <h4 class="green-text">€{{ number_format($product->price,2,",",".") }}/stuk</h4>
                    </div>
                    <div class="card-block pl-0">
                        <h4>product-code</h4>
                        <h4 class="green-text">{{ $product->code }}</h4>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card-block pl-0 text-center">
                        <h1>{{$product->brand->name . ' - ' . $product->name }}</h1>
                    </div>
                    <div class="card-block text-center row">
                        <div class="col-12 col-md-6">
                            <button class="btn primary-color p-3" href="#" data-toggle="modal"
                                    data-target="#{{ $product->id }}">
                                Toevoegen aan winkelmand
                            </button>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="dropdown d-inline">

                                <!--Trigger-->
                                <button class="btn btn-danger dropdown-toggle p-3" type="button"
                                        id="dropdownMenu2"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Toevoegen aan favorieten
                                </button>

                                <!--Menu-->
                                <div class="dropdown-menu dropdown-danger">
                                    @foreach($wishlists as $wishlist)
                                        <a class="dropdown-item"
                                           href="{{ action("WishlistController@add", ["product_id"=>$product->id, "wishlist_id"=>$wishlist->id ])}}">{{ $wishlist->name }}</a>
                                    @endforeach()
                                    <a class="dropdown-item"
                                       href="{{ action("WishlistController@create")}}">+ Maak nieuwe lijst</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-block pl-0">
                        <h3 class="text-center">Beschrijving</h3>
                        <p>{!! $product->description !!}</p>
                    </div>
                    <div class="card-block pl-0">
                        <h3 class="text-center">extra informatie</h3>
	                    <p>
		                    @if($download)
			                    <a href="{{ $download }}" target="_blank">{{ basename($download) }}</a>
		                    @else
		
		                    @endif
	                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Central Modal Medium -->
    <div class="modal fade" id="{{ $product->id }}" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-notify modal-success" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <p class="heading lead">Toevoegen</p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->
                <form class="" action="{{ action("CartController@store") }}" method="post">
                    <div class="modal-body mx-4 row">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <table class="col-12">
                            <thead>
                            <tr>
                                <th class="w-100">
                                    product
                                </th>
                                <th>
                                    aantal
                                </th>
                            </tr>
                            </thead>
                            <tr>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td>
                                    <input name="amount"
                                           onchange="updatePrice({{ $product->id }},{{ $product->price }},this.value)"
                                           type="number" required value="1" min="0" max="1000">
                                </td>
                            </tr>
                        </table>
                        <div id="modal_price_{{ $product->id }}" class="ml-auto mr-0 mt-2">1 &times;
                            €{{ number_format($product->price,2,',','.') }}
                            = {{ number_format($product->price,2,',','.') }}</div>

                    </div>

                    <!--Footer-->
                    <div class="modal-footer justify-content-around">
                        <a type="button" class="btn btn-outline-secondary waves-effect"
                           data-dismiss="modal">Annuleren</a>
                        <button type="submit" class="btn btn-primary">Voeg toe</button>
                    </div>
                </form>
            </div>
            <!--/.Content-->
        </div>
    </div>
@endsection

@section('scripts')

@endsection