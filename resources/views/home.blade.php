@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-2 pt-2">
            <div class="col-12 p-0 pl-1 mb-1">
                <div class="card primary-color text-center white-text pt-2 pb-1">
                    <h1 class="font-weight-bold"><b>Jansma Boerenproducten</b></h1>
                </div>
            </div>
            {{--<div class="col-12 mt-2"><h1><b>Nieuw</b></h1></div>--}}
            <div class="col-sm-10 col-lg-9">
                <div class="row pr-1">
                    @for($i = 0; $i < 3; $i++)
                        <div class="col-4 px-1 mb-1">
                            <a href="{{ action('ProductController@show', $products[$i]->id) }}">
                                <div class="card white hoverable h-100 home-product">
                                    {{--<div class="corner-ribbon top-right green">Nieuw</div>--}}
                                    <h4 class="text-center mt-2"><span class="badge green">Nieuw</span></h4>
                                    <h4 class="text-center black-text px-2">{{ $products[$i]->name }}</h4>
                                    <div class="thumbimg"
                                         style="background-image: url({{ asset("img/producten/".$products[$i]->code.".jpg") }})">
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endfor
                    <div class="col-6 px-1 mb-1">
                        <a href="{{ route('producten') }}">
                            <div class="card hoverable p-0">
                                <img class="img-fluid" src="/img/block_1.jpg">
                            </div>
                        </a>
                    </div>
                    <div class="col-6 px-1 mb-1">
                        <a href="{{ route('favorieten.index') }}">
                            <div class="card hoverable p-0">
                                <img class="img-fluid" src="/img/block_2.jpg">
                            </div>
                        </a>
                    </div>
                    @for($i = 0; $i < 3; $i++)
                        <div class="col-4 px-1">
                            <a href="{{ action('ProductController@show', $products[$i]->id) }}">
                                <div class="card white hoverable h-100 home-product">
                                    {{--<div class="corner-ribbon top-right blue">Uitgelicht</div>--}}
                                    <h4 class="text-center mt-2"><span class="badge blue">Uitgelicht</span></h4>
                                    <h4 class="text-center black-text px-2">{{ $products[$i]->  name }}</h4>
                                    <div class="thumbimg"
                                         style="background-image: url({{ asset("img/producten/".$products[$i]->code.".jpg") }})">
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="col-sm-2 col-lg-3 card home-block p-0 fb-container">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.9";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        $(window).ready(loadFbWidget());

        function loadFbWidget() {
            var height = $('.fb-container').height();
            $('.fb-container').html('<div class="fb-page card-block p-0" data-href="https://www.facebook.com/JansmaHaule.nl" data-tabs="timeline" data-width="500" data-height="' + Math.round(height) + '" data-hide-cover="false" data-show-facepile="false" data-show-posts="false">');
        }
    </script>
@endsection
