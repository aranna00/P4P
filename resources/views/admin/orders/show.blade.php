@extends("admin.layouts.app")

@section("breadcrumbs")
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="fa fa-home"></i>
            <a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ action("Admin\OrderController@index") }}">Orders</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ action("Admin\OrderController@show", $order->id) }}">Order {{ $order->id }}</a>
        </li>
    </ol>
@endsection

@section('content')
    <div class="card mb-2">
        <div class="card-header primary-color white-text">
            Order {{ $order->id }}
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Aantal</th>
                        <th>Prijs</th>
                        <th>Totaal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($order->products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->pivot->amount }}</td>
                            <td>&euro;{{ number_format($product->price, 2, ",", ".") }}</td>
                            <td>
                                &euro;{{ number_format($product->price * $product->pivot->amount, 2, ",", ".") }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-block row mt-2">
            <div class="col-md-3 col-xl-2 col-sm-6 col-float-md-right ml-auto">
                <ul class="striped">
                    <li><strong>Sub Totaal:</strong><span
                                class="float-right">&euro;{{ number_format($total, 2, ",", ".") }}</span></li>
                    <li><strong>BTW:</strong><span
                                class="float-right">&euro;{{ number_format($tax, 2, ",", ".") }}</span></li>
                    <li><strong>Totaal:</strong><span
                                class="float-right">&euro;{{ number_format($total + $tax, 2, ",", ".") }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection