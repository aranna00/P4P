@extends('layouts.app')

@section('content')
    <div class="container-fluid p-3 mt-4">
        <div class="row">
            @for ($i = 0; $i < 3; $i++)
            <div class="col col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Mijn favorieten lijst</h4>

                        <p class="card-text">De standaard favorieten lijst.</p>

                        <a href="#" class="btn btn-primary">Bekijk deze lijst</a>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
@endsection
