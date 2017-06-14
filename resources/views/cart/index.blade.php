@extends('layouts.app')

@section('content')
    <main id="mainContainer">
        <div class="container">
            <section>
                <div class="table-responsive mt-5">
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
                                        <img src="https://fanart.tv/fanart/music/88bdc8b5-b254-40f4-b626-434332081c05/artistbackground/duijts-frans-50fa82f99e7f0.jpg"
                                             alt=""
                                             class="img-fluid z-depth-0">
                                    </th>
                                    <td>
                                        <h5><strong>{{ $product->name }}</strong></h5>
                                        <p class="text-muted">{{ $product->description }}</p>
                                    </td>
                                    <td>&euro;{{ $product->price }}</td>
                                    <td class="center-on-small-only">
                                        <span class="qty">{{ $product->pivot->amount }} </span>
                                        <div class="btn-group radio-group" data-toggle="buttons">
                                            <label class="btn btn-sm btn-primary btn-rounded">
                                                <input type="radio" name="options" id="option1">&mdash;
                                            </label>
                                            <label class="btn btn-sm btn-primary btn-rounded">
                                                <input type="radio" name="options" id="option2">+
                                            </label>
                                        </div>
                                    </td>
                                    <td>&euro;{{ $product->price * $product->pivot->amount }}</td>
                                    <td>
                                        <form id="delete{{ $product->id }}"
                                              action="{{ action("CartController@update", ["product"=>$product->id]) }}"
                                              method="post">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="amount" value="0">
                                            {!! method_field("put") !!}

                                            <a class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                                               title="Verwijder uit winkelwagen"
                                               onclick="if (confirm('Weet u zeker dat u dit item uit de winkelwagen wilt verwijderen?')){ {$('#delete{{ $product->id }}').submit();} }">X
                                            </a>
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
                                    <h4><strong>&euro;0</strong></h4></td>
                                <td colspan="3">
                                    <button type="button" class="btn btn-primary">Order plaatsen <i
                                                class="fa fa-angle-right right"></i></button>
                                </td>
                            </tr>
                        @endif
                        <!-- /.Checkout -->
                        </tbody>
                        <!-- /.Table body -->
                    </table>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('scripts')
@endsection