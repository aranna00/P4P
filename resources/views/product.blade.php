@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">

        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 hidden-sm-down">
                <div class="mt-2 ml-2">
                    <!-- Panel -->
                    <h5><strong>BROWSE</strong></h5>
                    <div class="divider"></div>

                    <ul>
                        <li>
                            <input type="checkbox" id="checkbox1">
                            <label for="checkbox1">Bags</label>
                        </li>

                        <li>
                            <input type="checkbox" id="checkbox2">
                            <label for="checkbox2">Booking</label>
                        </li>

                        <li>
                            <input type="checkbox" id="checkbox3">
                            <label for="checkbox3">Clothing</label>
                        </li>

                        <li>
                            <input type="checkbox" id="checkbox4" checked="checked">
                            <label for="checkbox4">Shoes</label>
                        </li>

                        <li>
                            <input type="checkbox" id="checkbox5">
                            <label for="checkbox5">Music</label>
                        </li>

                        <li>
                            <input type="checkbox" id="checkbox6">
                            <label for="checkbox6">Posters</label>
                        </li>
                    </ul>

                    <!-- Filter by color-->
                    <h5 class="pt-2"><strong>COLOR</strong></h5>
                    <div class="divider"></div>

                    <ul>
                        <li>
                            <input type="checkbox" id="checkbox9" checked="checked">
                            <label for="checkbox9">White</label>
                        </li>

                        <li>
                            <input type="checkbox" id="checkbox12">
                            <label for="checkbox10">Beige</label>
                        </li>

                        <li>
                            <input type="checkbox" id="checkbox11">
                            <label for="checkbox11">Black</label>
                        </li>

                        <li>
                            <input type="checkbox" id="checkbox12">
                            <label for="checkbox12">Green</label>
                        </li>
                    </ul>

                    <!-- Filter by size -->
                    <h5 class="pt-2"><strong>SIZE</strong></h5>
                    <div class="divider"></div>

                    <ul>
                        <li>
                            <input type="checkbox" id="checkbox13">
                            <label for="checkbox13">Extra Small</label>
                        </li>

                        <li>
                            <input type="checkbox" id="checkbox14">
                            <label for="checkbox14">Small</label>
                        </li>

                        <li>
                            <input type="checkbox" id="checkbox15" checked="checked">
                            <label for="checkbox15">Medium</label>
                        </li>
                    </ul>
                    <!--/.Panel-->

                </div>
                <div class="sticky-placeholder" style="width: 255px; height: 864px;"></div>

            </div>
            <!-- /.Sidebar -->

            <!-- Content -->
            <div class="col-md-10 my-2">
                @for($x = 0; $x < 20; $x++)

                    <div class="list-group">
                        <div class="list-group-item list-group-item-action row px-0 mx-0">
                            <div class="col-1">
                                <img src="http://www.supermarktaanbiedingen.com/public/images/product/2014/34/90411-4-57.jpg"
                                     style="max-height: 10vh" class="img-fluid">
                            </div>

                            <div class="col-6">
                                <h5 class="mb-1">Kaas</h5>
                                <small>Rond het jaar 800 was het gebied, dat nu de gemeente Beemster vormt, bedekt met
                                    veen. Beemster is afgeleid van Bamestra, de naam van een riviertje in het gebied.
                                </small>
                            </div>
                            <div class="col-3 text-center">
                                <h5>€5,99/stuk</h5>
                            </div>
                            <div class="col-2 text-center">
                                <a class="btn btn-large primary-color" href="#"><i class="fa fa-fix fa-shopping-cart"></i></a>
                                <a class="btn btn-large red"><i class="fa fa-fix fa-star"></i></a>
                            </div>
                        </div>
                    </div>
                @endfor

            </div>
            <!-- /.Filter Area -->


        </div>
        <!-- /.Content -->

    </div>

    </div>
@endsection