@extends('layouts.app')

@section('content')
    <main id="mainContainer">
        <div class="container-fluid mt-5">
            <section>
                <div class="card">
                    <div class="card-header primary-color-darken white-text">
                        Winkelwagen
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
                                            <td scope="row">
                                                <img src="{{ asset("img/producten/".$product->code.".jpg") }}"
                                                     onerror="this.src='{{ asset("img/noimage.png") }}'"
                                                     alt=""
                                                     class="img-fluid z-depth-0">
                                            </td>
                                            <td>
                                                <h5><strong>{{ $product->name }}</strong></h5>
                                                <p class="text-muted">{!! $product->description !!}</p>
                                            </td>
	                                        <td class="cart-price" data-price="{{ $product->price    }}">
		                                        &euro;{{ number_format($product->price, 2, ",", ".") }}</td>
                                            <td>
                                                <form id="update{{ $product->id }}"
                                                      action="{{ action("CartController@update", ["product"=>$product->id]) }}"
                                                      method="post">
                                                    {!! csrf_field() !!}
                                                    {!! method_field("put") !!}
                                                    <input type="hidden" value="{{ $product->id }}" name="id">

                                                    <div class="input-group">
	                                                    <input data-id="{{ $product->id }}"
	                                                           class="form-control cart-amount" type="number"
	                                                           name="amount"
	                                                           value="{{ $product->pivot->amount }}" min="0"
	                                                           title="amount" src="">
                                                    </div>
                                                </form>
                                            </td>
	                                        <td class="cart-total">
		                                        &euro;{{ number_format($product->price * $product->pivot->amount, 2, ",", ".") }}
	                                        </td>
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
	                                        <h4><strong id="cart-total"
	                                                    data-price="{{ $total }}">&euro;{{ number_format($total, 2, ",", ".") }}</strong>
	                                        </h4></td>
                                        <td colspan="2">
                                            <a href="{{ act ion("CheckoutController@index") }}">
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
	
	<script>
        Number.prototype.formatMoney = function (c, d, t) {
            var n = this,
                c = isNaN(c = Math.abs(c)) ? 2 : c,
                d = d == undefined ? "," : d,
                t = t == undefined ? "." : t,
                s = n < 0 ? "-" : "",
                i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
                j = (j = i.length) > 3 ? j % 3 : 0;
            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        };
        var cartTotal = $("#cart-total");
        var prevValue;
        $(".cart-amount").focusin(function () {
            prevValue = $(this).prop("value");
        });
        $(".cart-amount").change(function () {
            var row = $(this).parent().parent().parent().parent();
            var rowTotal = row.find(".cart-total");
            var currentRowTotal = rowTotal.html();
            var currentCartTotal = cartTotal.html();
            var that = $(this);
            $.ajax({
                url: "{{ action("CartController@index") }}/" + $(this).data("id"),
                method: "post",
                data: {
                    _method: "put",
                    _token: "{{ csrf_token() }}",
                    amount: $(this).prop("value"),
                    id: $(this).data("id")
                },
                success: function (data) {
                    rowTotal.text("€" + data.productTotal.formatMoney(2));
                    cartTotal.text("€" + data.total.formatMoney(2));
                },
                beforeSend: function (data) {
                    rowTotal.html("<i class='fa fa-spinner fa-spin'></i>");
                    cartTotal.html("<i class='fa fa-spinner fa-spin'></i>");
                },
                error: function () {
                    rowTotal.html(currentRowTotal);
                    cartTotal.html(currentCartTotal);
                    that.prop("value", prevValue);
                    toastr["error"]("Er ging wat fout tijdens het veranderen van de winkelwagen", "Probeer het later opnieuw");
                }
            })
        });
	</script>
    
@endsection