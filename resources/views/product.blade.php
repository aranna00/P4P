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

                    <div class="card mb-2">
                        <!-- Panel -->
                        <div class="card-header">
                            <h5 class="m-0"><strong>filter</strong></h5>
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

                @endif

            </div>
            <!-- /.Sidebar -->

            <!-- Content -->
            <div class="col-md-10 my-2">

                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('product')}}">Productennnnnn</a></li>
                    @if(isset($breadcrumbs))
                        @foreach(array_reverse($breadcrumbs) as $breadcrumb)
                            <li class="breadcrumb-item"><a
                                        href="{{ action("ProductController@filtered", $breadcrumb[0]) }}">{{ $breadcrumb[1] }}</a>
                            </li>
                        @endforeach
                    @endif
                </ol>

                @if(isset($products))
                    @foreach($products as $product)

                        <div class="list-group">
                            <div class="list-group-item list-group-item-action row px-0 mx-0">
                                <div class="col-1">
                                    <img src="http://www.supermarktaanbiedingen.com/public/images/product/2014/34/90411-4-57.jpg"
                                         style="max-height: 10vh" class="img-fluid">
                                </div>

                                <div class="col-6">
                                    <h5 class="mb-1">{{ $product->brand_id }} - {{ $product->name }}</h5>
                                    <small>{{ $product->description }}</small>
                                </div>
                                <div class="col-3 text-center">
                                    <h5>€{{ $product->price }}/stuk</h5>
                                </div>
                                <div class="col-2 text-center">
                                    <a class="btn btn-large primary-color" href="#"><i
                                                class="fa fa-fix fa-shopping-cart"></i></a>
                                    <a class="btn btn-large red"><i class="fa fa-fix fa-star"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
            <!-- /.Filter Area -->


        </div>
        <!-- /.Content -->

    </div>

    </div>
@endsection