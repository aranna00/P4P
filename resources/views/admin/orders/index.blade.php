@extends("admin.layouts.app")

@section("breadcrumbs")
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="fa fa-home"></i>
            <a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ action("Admin\OrderController@index") }}">Gebruikers</a>
        </li>
    </ol>
@endsection

@section("content")
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header primary-color text-center white-text">
                    Alle Bestellingen
                </div>
                <div class="admin-panel info-admin-panel">
                    <div class="col-md-12">
                        <div class="card-block pt-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Bedrijf</th>
                                        <th>Gebruiker</th>
                                        <th>Gewenste bezorgdatum</th>
                                        <th>Status</th>
                                        <th>Acties</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>
                                                {{ $order->id }}
                                            </td>
                                            <td>
                                                {{ $order->user->business->bestaandehandelsnaam }}
                                            </td>
                                            <td>
                                                {{ $order->user->first_name . " " . $order->user->last_name }}
                                            </td>
                                            <td>
                                                {{ $order->delivery }}
                                            </td>
                                            <td>
                                                {{ $order->processed?"Verwerkt":"Nog niet verwerkt" }}
                                            </td>
                                            <td>
                                                <form action="{{ action("Admin\OrderController@update",["order"=>$order->id]) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field("put") }}
                                                    <button class="btn btn-primary btn-sm" name="process" onclick="if (confirm('Weet u zeker dat u deze order al verwerkt wil aangeven?')){ {$('#update{{ $order->id }}').submit();} }">Verwerken</button>
                                                    <a href="{{ action("Admin\OrderController@show", $order->id) }}">
                                                        <button class="btn btn-primary btn-sm">henk</button>
                                                    </a>
                                                </form>


                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{--{!! $orders->links() !!}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection