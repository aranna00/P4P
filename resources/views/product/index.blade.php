@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4 mx-2">

        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 hidden-sm-down mt-2">
                @if(count($categories) > 0)
                    <div class="card mb-2">
                        <!-- Panel -->
                        <div class="card-header">
                            <h5 class="m-0"><strong>Categorie</strong></h5>
                        </div>
                        <div class="card-block p-3">
                            <ul class="m-0">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ action("ProductController@filtered", ["category"=>$category->id]) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if(Route::current()->getName() == 'filtered')

                    @foreach($attribute_groups as $attribute_group)
                        <div class="card mb-2">
                            <!-- Panel -->
                            <div class="card-header">
                                <h5 class="m-0"><strong>{{ $attribute_group->name }}</strong></h5>
                            </div>
                            <div class="card-block p-3">
                                <ul class="m-0">
                                    <li>
                                        <input type="checkbox" id="checkbox">
                                        <label for="checkbox">Item</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="checkbox2">
                                        <label for="checkbox2">Item</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="checkbox3" checked>
                                        <label for="checkbox3">Item</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach

                @endif

            </div>
            <!-- /.Sidebar -->

            <!-- Content -->
            <div class="col-md-10 my-2">

                <ol class="breadcrumb breadcrumb-white">
                    <li class="breadcrumb-item"><a href="{{route('product')}}">Producten</a></li>
                    @if(isset($breadcrumbs))
                        @foreach(array_reverse($breadcrumbs) as $breadcrumb)
                            <li class="breadcrumb-item"><a
                                        href="{{ action("ProductController@filtered", $breadcrumb[0]) }}">{{ $breadcrumb[1] }}</a>
                            </li>
                        @endforeach
                    @endif
                </ol>

                @foreach($products as $product)

                    <div class="list-group">
                        <div class="list-group-item list-group-item-action row px-0 mx-0">
                            <div class="col-1">
                                <img src="http://www.supermarktaanbiedingen.com/public/images/product/2014/34/90411-4-57.jpg"
                                     style="max-height: 10vh" class="img-fluid">
                            </div>

                            <div class="col-6">
                                <h5 class="mb-1">{{ $product->brand->name }} - {{ $product->name }}</h5>
                                <small>{{ $product->description }}</small>
                            </div>
                            <div class="col-3 text-center">
                                <h5>€{{ number_format($product->price,2,',','.') }}/stuk</h5>
                            </div>
                            <div class="col-2 text-center">
                                <button class="btn btn-large primary-color" href="#" data-toggle="modal"
                                        data-target="#{{ $product->id }}">&nbsp;<i
                                            class="fa fa-fix fa-shopping-cart"></i>&nbsp;&nbsp;</button>
                                <div class="dropdown">

                                    <!--Trigger-->
                                    <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu2"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                class="fa fa-fix fa-star"></i></button>

                                    <!--Menu-->
                                    <div class="dropdown-menu dropdown-danger">
                                        @foreach($wishlists as $wishlist)
                                            <a class="dropdown-item"
                                               href="{{ action("WishlistController@add", ["product_id"=>$product->id, "wishlist_id"=>$wishlist->id ])}}">{{ $wishlist->name }}</a>
                                        @endforeach()
                                        <a class="dropdown-item"
                                           href="{{ action("WishlistController@create")}}">+    `npmMaak nieuwe lijst</a>
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
                                    <p class="heading lead">Hoeveelheid</p>

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
                                    <div class="modal-footer justify-content-center">
                                        <a type="button" class="btn btn-outline-secondary waves-effect"
                                           data-dismiss="modal">Annuleren</a>
                                        <button type="submit" class="btn btn-primary">Voeg toe</button>
                                    </div>
                                </form>
                            </div>
                            <!--/.Content-->
                        </div>
                    </div>
                    <!-- Central Modal Medium Success-->
                @endforeach

            </div>
            <!-- /.Filter Area -->


        </div>
        <!-- /.Content -->

    </div>
@endsection

@section('scripts')
    <script>
        function updatePrice(id, price, count) {
            document.getElementById("modal_price_" + id).innerHTML = count + " × €" + price.toFixed(2) + " = €" + (count * price).toFixed(2);
        }
    </script>
@endsection