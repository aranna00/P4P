@extends('layouts.app')

@section('content')
    <main id="mainContainer">
        <div class="container-fluid mt-5">
            <section>
                <div class="card">
                    <div class="card-header primary-color-darken white-text">
                        Mand
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table product-table">
                                <!-- Table head -->
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Product</th>
                                    <th>Prijs</th>
                                    <th>Aantal</th>
                                    <th>Totaal</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <!-- /.Table head -->

                                <!-- Table body -->
                                <tbody>
                                @if (count($cart) > 0)
                                    @foreach ($cart as $product)
                                        <tr>
                                            <th scope="row">
                                                <img src="{{ asset("img/producten/".$product->code.".jpg") }}"
                                                     onerror="this.src='{{ asset("img/noimage.png") }}'"
                                                     alt=""
                                                     class="img-fluid z-depth-0">
                                            </th>
                                            <td>
                                                <h5><strong>{{ $product->name }}</strong></h5>
                                                <p class="text-muted">{!! $product->description !!}</p>
                                            </td>
                                            <td>&euro;{{ number_format($product->price, 2, ",", ".") }}</td>
                                            <td>
                                                <form id="update{{ $product->id }}"
                                                      action="{{ action("CartController@update", ["product"=>$product->id]) }}"
                                                      method="post">
                                                    {!! csrf_field() !!}
                                                    {!! method_field("put") !!}
                                                    <input type="hidden" value="{{ $product->id }}" name="id">

                                                    <div class="input-group">
                                                        <input class="form-control" type="number" name="amount"
                                                               value="{{ $product->pivot->amount }}" min="0"
                                                               title="amount">
                                                        <span class="input-group-btn">
                                                            <button type="submit" class="btn blue btn-md">
                                                            <i class="fa fa-refresh"></i>
                                                        </button>
                                                        </span>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                &euro;{{ number_format($product->price * $product->pivot->amount, 2, ",", ".") }}</td>
                                            <td>
                                                <form id="delete{{ $product->id }}"
                                                      action="{{ action("CartController@update", ["product"=>$product->id]) }}"
                                                      method="post">
                                                    {!! csrf_field() !!}
                                                    {!! method_field("put") !!}
                                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                                    <input type="hidden" name="amount" value="0">

                                                    <i class="fa fa-fixed fa-2x fa-times text-grey hover-red" data-toggle="tooltip"
                                                       data-placement="top"
                                                       title="Verwijder uit winkelwagen"
                                                       onclick="if (confirm('Weet u zeker dat u dit item uit de winkelwagen wilt verwijderen?')){ {$('#delete{{ $product->id }}').submit();} }">

                                                    </i>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th></th>
                                        <td>Geen producten in winkelwagen</td>
                                    </tr>
                                @endif

                                <!-- Checkout -->
                                @if (count($cart) > 0)
                                    <tr>
                                        <td colspan="1"></td>
                                        <td>
                                            <h4><strong>Totaal</strong></h4></td>
                                        <td>
                                            <h4><strong>&euro;{{ number_format($total, 2, ",", ".") }}</strong></h4></td>
                                        <td colspan="3">
                                            <a href="{{ action("CheckoutController@index") }}">
                                                <button type="button" class="btn btn-primary">Verder naar order plaatsen
                                                    <i class="fa fa-angle-right right"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                                <!-- /.Checkout -->
                                </tbody>
                                <!-- /.Table body -->
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('scripts')
@endsection