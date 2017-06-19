@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5">
        <div class="card mb-2">
            <div class="card-block">
                <h2 class="card-title">Product overzicht</h2>
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
                        @foreach ($cart as $product)
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

        <div class="card mb-2">
            <div class="card-block">
                <h2 class="card-title">Uw gegevens</h2>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="md-form">
                            <input id="form1" class="form-control" type="text" disabled=""
                                   value="{{ $business->handelsnaam }}">
                            <label for="form1">Bedrijf</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h2>Factuuradres</h2>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-6">
                        <div class="md-form">
                            <input id="form6" class="form-control" type="text" value="{{ $billing->postcode }}">
                            <label for="form6">Postcode</label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="md-form">
                            <input id="form7" class="form-control" type="text" value="{{ $billing->huisnummer }}">
                            <label for="form7">Huisnummer</label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="md-form">
                            <input id="form8" class="form-control" type="text"
                                   value="{{ $billing->huisnummertoevoeging }}">
                            <label for="form8">Toevoeging</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                            <input id="form10" class="form-control" type="text" value="{{ $billing->plaats }}">
                            <label for="form10">Plaats</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h2>Afleveradres</h2>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-6">
                        <div class="md-form">
                            <input id="form3" class="form-control" type="text" value="{{ $shipping->postcode }}">
                            <label for="form3">Postcode</label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="md-form">
                            <input id="form4" class="form-control" type="text" value="{{ $shipping->huisnummer }}">
                            <label for="form4">Huisnummer</label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="md-form">
                            <input id="form5" class="form-control" type="text" {{ $shipping->huisnummertoevoeging }}>
                            <label for="form5">Toevoeging</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                            <input id="form9" class="form-control" type="text" value="{{ $shipping->plaats }}">
                            <label for="form9">Plaats</label>
                        </div>
                    </div>
                </div>
                <form method="post" action="{{ action("CheckoutController@checkout") }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form">
                                <input placeholder="Kies een datum" type="text" id="date-picker"
                                       class="form-control datepicker" name="date">
                                <label for="date-picker">Afleverdatum</label>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Plaats order</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.datepicker').pickadate({
            //Data Picker Customization
            monthsFull: [
                'Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober',
                'November', 'December'
            ],
            monthsShort: ['Jan', 'Feb', 'Mrt', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
            weekdaysFull: ['Zondag', 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag'],
            weekdaysShort: ['Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za'],

            today: 'Vandaag',
            clear: '',
            close: 'Sluit',

            format: 'dd-mm-yyyy',
            hiddenPrefix: 'd',
        });
    </script>
@endsection