@extends('layouts.app')

@section('content')
    <main id="maincontainer">
        <div class="container-fluid mt-5">
            <section>
                <div class="card mb-2">
                    <div class="card-header primary-color white-text">
                        Orders
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Order geplaatst</th>
                                    <th>Afleverdatum</th>
                                    <th>Status</th>
                                    <th>Acties</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($orders) > 0)
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->delivery }}</td>
                                            <td>@if ($order->processed) Verwerkt @else Nog niet verwerkt @endif</td>
                                            <td>
                                                <a href="{{ action('OrderController@show', ["order"=>$order->id]) }}" class="btn btn-sm btn-primary">
                                                    Bekijk order
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    Geen orders gevonden
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

@endsection