@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card mb-2">
            <div class="row px-3">
                <div class="col-md-3 pl-3 pt-1 pr-md-0 ">
                    <img src="{{ asset("img/producten/".$product->code.".jpg") }}"
                         class="img-fluid w-100 breadcrumb-white m-0">
                    <div class="card-block px-0">
                        <button class="btn primary-color p-3 w-100" href="#" data-toggle="modal"
                                data-target="#{{ $product->id }}">
                            Toevoegen aan winkelmand
                        </button>
                        <div class="dropdown d-inline w-100">

                            <!--Trigger-->
                            <button class="btn btn-danger dropdown-toggle p-3 w-100" type="button"
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
                <div class="col-md-9">
                    <div class="card-block pl-0 text-center">
                        <h1>
                            <span class="green-text">{{ $product->code }} </span>&nbsp; {{$product->brand->name . ' - ' . $product->name }}
                        </h1>
                        <h3 class="green-text">€{{ number_format($product->price,2,",",".") }}
                            / @if ($product->coli != 0){{$product->coli}} @elseif ($product->weight != 0){{$product->weight/1000 . ' kg'}} @else
                                stuk @endif</h3>
                    </div>


                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-3 primary-color" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">Beschrijving</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#panel2" role="tab">Productspecificaties</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#panel3" role="tab">Extra informatie</a>
                        </li>
                    </ul>
                    <!-- Tab panels -->
                    <div class="tab-content">
                        <!--Panel 1-->
                        <div class="tab-pane fade in show active" id="panel1" role="tabpanel">
                            <br>
                            {!! $product->description !!}
                        </div>
                        <!--/.Panel 1-->
                        <!--Panel 2-->
                        <div class="tab-pane fade" id="panel2" role="tabpanel">
                            <br>
                            <table class="table">
                                <thead class="font-weight-bold">
                                <tr>
                                    <td>Eigenschap</td>
                                    <td>Waarde</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attributes as $attribute)
                                    <tr>
                                        <td>{{ $attribute->attributeGroup->name }}</td>
                                        <td>{{ $attribute->value }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--/.Panel 2-->
                        <!--Panel 3-->
                        <div class="tab-pane fade text-center" id="panel3" role="tabpanel">
                            <br>
                            @if($download)
                                <p>Product informatie</p>
                                <a href="{{ $download }}" class="btn btn-info" target="_blank">Download</a>
                            @else
                                <p>Geen extra informatie beschikbaar</p>
                            @endif
                        </div>
                        <!--/.Panel 3-->
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