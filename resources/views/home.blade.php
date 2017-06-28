@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-2 pt-2">
            <div class="col-12 p-0 pl-1 mb-1">
                <div class="card primary-color text-center white-text pt-2 pb-1">
                    <h1 class="font-weight-bold"><b>Jansma Boerenproducten</b></h1>
                </div>
            </div>
            <div class="col-12 col-lg-9 pr-lg-5">
                <div class="row">
                    <div class="slick col-12 px-0"
                         data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "autoplaySpeed": 3000 }'>
                        @foreach($new as $item)
                            <div class="col-12 col-md-4 px-1 mb-1 carousel-height">
                                <a href="{{ action('ProductController@show', $item->id) }}">
                                    <div class="card white hoverable h-100 home-product">
                                        {{--<div class="corner-ribbon top-right green">Nieuw</div>--}}
                                        <h4 class="text-center mt-2"><span class="badge green">Nieuw</span></h4>
                                        <h4 class="text-center black-text px-2">{{ $item->name }}</h4>
                                        <div class="thumbimg"
                                             style="background-image: url({{ asset("img/producten/".$item->code.".jpg") }})">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-6 px-1 mb-1">
                        <a href="{{ route('producten') }}">
                            <div class="card hoverable p-0">
                                <img class="img-fluid" src="/img/block_1.jpg">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 px-1 mb-1">
                        <a href="{{ route('favorieten.index') }}">
                            <div class="card hoverable p-0">
                                <img class="img-fluid" src="/img/block_2.jpg">
                            </div>
                        </a>
                    </div>
                    <div class="slick col-12 px-0"
                         data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "autoplaySpeed": 4000}'>
                        @foreach($featured as $item)
                            <div class="col-12 col-md-4 px-1 mb-1 carousel-height">
                                <a href="{{ action('ProductController@show', $item->id) }}">
                                    <div class="card white hoverable h-100 home-product">
                                        {{--<div class="corner-ribbon top-right green">Nieuw</div>--}}
                                        <h4 class="text-center mt-2"><span class="badge blue">Uitgelicht</span></h4>
                                        <h4 class="text-center black-text px-2">{{ $item->name }}</h4>
                                        <div class="thumbimg"
                                             style="background-image: url({{ asset("img/producten/".$item->code.".jpg") }})">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-3 card home-block p-0 mb-1 fb-container hidden-md-down">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/slick.js') }}"></script>
    <script>
        $('.slick').slick({
            autoplay: true,
            prevArrow: '<i class="fa fa-caret-left carousel-left"></i>',
            nextArrow:'<i class="fa fa-caret-right carousel-right"></i>'

        });
    </script>
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
