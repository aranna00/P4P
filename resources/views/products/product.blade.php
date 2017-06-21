@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card mb-2">
            <div class="row px-3">
                <div class="col-md-3 pl-3 pt-1 pr-md-0 ">
                    <img src="{{ asset("img/producten/".$product->code.".jpg") }}" class="img-fluid w-100 breadcrumb-white m-0">
                    <div class="card-block pl-0">
                        <h4>Prijs</h4>
                        <h4 class="green-text">€{{ number_format($product->price,2,",",".") }}/stuk</h4>
                    </div>
                    <div class="card-block pl-0">
                        <h4>product-code</h4>
                        <h4 class="green-text">{{ $product->code }}</h4>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card-block pl-0">
                        <h1>{{$product->brand->name . ' - ' . $product->name }}</h1>
                        {{--<h2 class="green-text">€{{ $product->price }}/stuk</h2>--}}
                    </div>
                    <div class="card-block pl-0">
                        <h3>Beschrijving</h3>
                        <p>{!! $product->description !!}</p>
                    </div>
                    <div class="card-block pl-0">
                        <h3>extra informatie</h3>
                        <p>{!! $product->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection