<div class="card card-grey">
    <div class="card-block mx-auto p-0 pt-1">
{!! $products->withPath("/filter/".$parentId) !!}
    </div>
</div>
@foreach($products as $product)

    <div class="list-group m-0">
        <div class="list-group-item list-group-item-action row px-0 mx-0 products-card">
            <div class="col-2 col-lg-1 p-0">
                <img src="{{ asset("img/producten/".$product->code.".jpg") }}"
                     onerror="this.src='{{ asset("img/noimage.png") }}'"
                     style="max-height: 10vh" class="img-fluid mx-auto">
            </div>

            <div class="col-1 hidden-sm-down text-center">
                <h5 class="hidden-md-down"><b>{{ $product->code }}</b></h5>
            </div>

            <div class="col-5 col-sm-5 col-lg-6">
                <a href="{{ action('ProductController@show', $product->id) }}">
                    <h5 class="mb-1 hidden-sm-down">{{ $product->brand->name }} - {{ $product->name }}</h5>
                    <h6 class="mb-1 hidden-md-up">{{ $product->brand->name }}</h6>
                    <h6 class="mb-1 hidden-md-up">{{ $product->name }}</h6>
                </a>
                <small class="short-description hidden-sm-down">{!! $product->description !!}</small>
            </div>

            <div class="col-2 text-center">
                <h5 class="hidden-md-down">€{{ number_format($product->price,2,",",".") }}</h5>
                <h6 class="hidden-lg-up">€{{ number_format($product->price,2,",",".") }}</h6>
            </div>
            <div class="col-3 col-sm-2 col-md-2 text-center btn-group">
                <button class="btn primary-color p-3 hidden-md-down" href="#" data-toggle="modal"
                        data-target="#{{ $product->id }}">&nbsp;<i
                            class="fa fa-fix fa-shopping-cart"></i>&nbsp;&nbsp;
                </button>
                <button class="btn primary-color p-3 hidden-lg-up" href="#" data-toggle="modal"
                        data-target="#{{ $product->id }}"><i
                            class="fa fa-fix fa-shopping-cart"></i>
                </button>
                <div class="dropdown">

                    <!--Trigger-->
                    <button class="btn btn-danger dropdown-toggle hidden-md-down p-3" type="button" id="dropdownMenu2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fa fa-fix fa-star"></i></button>

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
@endforeach
<div class="card card-grey">
    <div class="card-block mx-auto p-0 pt-1">
        {!! $products->withPath("/filter/".$parentId) !!}
    </div>
</div>

@if(count($products)===0)

    <div class="list-group">
        <div class="list-group-item list-group-item-action row px-0 mx-0">
            <div class="col-12">
                Er zijn geen producten gevonden met deze zoek criteria
            </div>
        </div>
    </div>

@endif

@section('scripts')

@endsection