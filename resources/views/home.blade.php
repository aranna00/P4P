@extends('layouts.app')

@section('content')
    <div class="container-fluid row m-0 p-0">
        <div class="col-sm-6 col-lg-3 card home-block px-0"><!--Card image-->
            <div class="view overlay hm-white-slight home-block-image">
                <img src="https://cookinglife.nl/uploads/webshop/hertog%202.jpg" class="" alt="">
                <a>
                    <div class="mask waves-effect waves-light"></div>
                </a>
            </div>
            <!--/.Card image-->

            <!--Button-->
            <a class="btn-floating btn-action"><i class="fa fa-chevron-right"></i></a>

            <!--Card content-->
            <div class="card-block">
                <!--Title-->
                <h4 class="card-title">Alle producten</h4>
                <hr>
                <!--Text-->
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
            </div>
            <!--/.Card content-->
        </div>
        <div class="col-sm-6 col-lg-3 card home-block px-0"><!--Card image-->
            <div class="view overlay hm-white-slight home-block-image">
                <img src="https://cookinglife.nl/uploads/webshop/hertog%202.jpg" class="" alt="">
                <a>
                    <div class="mask waves-effect waves-light"></div>
                </a>
            </div>
            <!--/.Card image-->

            <!--Button-->
            <a class="btn-floating btn-action"><i class="fa fa-chevron-right"></i></a>

            <!--Card content-->
            <div class="card-block">
                <!--Title-->
                <h4 class="card-title">Card title</h4>
                <hr>
                <!--Text-->
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
            </div>
            <!--/.Card content-->
            >
        </div>
        <div class="col-sm-6 col-lg-3 card home-block px-0"><!--Card image-->
            <div class="view overlay hm-white-slight home-block-image">
                <img src="https://cookinglife.nl/uploads/webshop/hertog%202.jpg" class="" alt="">
                <a>
                    <div class="mask waves-effect waves-light"></div>
                </a>
            </div>
            <!--/.Card image-->

            <!--Button-->
            <a class="btn-floating btn-action"><i class="fa fa-chevron-right"></i></a>

            <!--Card content-->
            <div class="card-block">
                <!--Title-->
                <h4 class="card-title">Card title</h4>
                <hr>
                <!--Text-->
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
            </div>
            <!--/.Card content-->
        </div>
        <div class="col-sm-6 col-lg-3 card home-block px-0 fb-container">
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

        $(window).bind("load resize", function () {
            var height = $('.fb-container').height();
            $('.fb-container').html('<div class="fb-page card-block p-0" data-href="https://www.facebook.com/JansmaHaule.nl" data-tabs="timeline" data-width="500" data-height="' + height + '" data-hide-cover="false" data-show-facepile="false" data-show-posts="false">');
            FB.XFBML.parse();
        });
    </script>
@endsection
