@extends("admin.layouts.app")

@section("breadcrumbs")

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="fa fa-home"></i>
            <a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ action("Admin\ProductController@index") }}">Producten</a>
        </li>
    </ol>

@endsection


@section("content")
    <div class="col-md-12">
        <div class="card">
            <div class="card-header primary-color text-center white-text">
                Alle producten
            </div>
            <div class="admin-panel info-admin-panel">
                <div class="col-md-12">
                    <div class="card-block pt-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Naam</th>
                                    <th>Beschrijving</th>
                                    <th>Merk</th>
                                    <th>Prijs</th>
                                    <th>Beschikbaar</th>
                                    <th>Aanmaakdatum</th>
                                    <th>Acties</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>
                                            {{ $product->name }}
                                        </td>
                                        <td>
                                            {!! str_limit($product->description,150) !!}
                                        </td>
                                        <td>
                                            {{ $product->brand->name }}
                                        </td>
                                        <td>
                                            &euro;{{ number_format($product->price, 2, ",", ".") }}
                                        </td>
                                        <td>
                                            {{ $product->isAvailable()?"Ja":"Nee" }}
                                        </td>
                                        <td>
                                            {{ $product->created_at }}
                                        </td>
                                        <td>
                                            <form id="delete{{ $product->id }}"
                                                  action="{{ action("Admin\ProductController@destroy", ["brand"=>$product->id]) }}"
                                                  method="post" class="btn-group">
                                                {!! csrf_field() !!}
                                                {!! method_field("delete") !!}
                                                <a class="btn btn-primary"
                                                   href="{{ action("Admin\ProductController@edit",["product"=>$product->id]) }}">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a class="btn btn-info @if($product->featured == '1')active @endif"
                                                   href="{{ action("Admin\ProductController@featured",["product"=>$product->id]) }}">
                                                    <i class="fa fa-lightbulb-o"></i>
                                                </a>
                                                <a class="btn btn-danger"
                                                   onclick="if (confirm('Weet u het zeker')){ {$('#delete{{ $product->id }}').submit();} }"><i
                                                            class="fa fa-times"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $products->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="btn-floating btn-large primary-color" style="position: fixed; bottom: 45px; right: 24px;"
       href="{{ action("Admin\ProductController@create") }}">
        <i class="fa"><b>+</b></i>
    </a>
@endsection