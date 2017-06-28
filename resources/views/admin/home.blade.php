@extends("admin.layouts.app")

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="fa fa-home"></i>
            <a href="{{ action("Admin\HomeController@index") }}">Beheer</a>
        </li>
    </ol>
@endsection

@section('content')
    <div class="card mb-2">
        <div class="row m-b-0">

            <!--First column-->
            <div class="col-md-5">

                <!--Panel title-->
                <div class="card-header primary-color center-text white-text">
                    <h2>Verkoopcijfers</h2>
                </div>
                <!--/Panel title-->

                <!--Panel data-->
                <div class="row card-block pt-3">

                    <!--First column-->
                    <div class="col-md-5">

                        <!--Date select-->
                        <h4><span class="badge big-badge primary-color">Tijd periode</span></h4>
                        <select class="mdb-select colorful-select dropdown-primary">
                            <option value="" disabled selected>Kies tijd periode</option>
                            <option value="1">Vandaag</option>
                            <option value="2">Gisteren</option>
                            <option value="3">Afgelopen week</option>
                            <option value="4">Afgelopen maand</option>
                            <option value="5">Afgelopen jaar</option>
                        </select>
                        <br>

                        <!--Date pickers-->
                        <h4><span class="badge big-badge primary-color">Aangepaste datum</span></h4>
                        <br>
                        <div class="md-form">
                            <input placeholder="Kies een datum" type="text" id="from" class="form-control datepicker">
                            <label for="date-picker-example">Vanaf</label>
                        </div>
                        <div class="md-form">
                            <input placeholder="Kies een datum" type="text" id="to" class="form-control datepicker">
                            <label for="date-picker-example">Tot</label>
                        </div>

                    </div>
                    <!--/First column-->

                    <!--Second column-->
                    <div class="col-md-6">
                        <!--Summary-->
                        <h4><span class="badge big-badge primary-color">Samenvatting</span></h4>
                        <p>Totaal aantal orders: <strong>18</strong></p>
                        <p>Totaal bedrag: <strong>&euro;225</strong></p>
                    </div>
                    <!--/Second column-->

                </div>
                <!--/Panel data-->
            </div>
            <!--/First column-->

            <!--Second column-->
            <div class="col-md-7 p-5">
                <!--Cascading element-->
                <div class="view right primary-color">
                    <!--Main chart-->
                    <canvas id="sales" height="155px"></canvas>
                </div>
                <!--/Cascading element-->
            </div>
            <!--/Second column-->

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            var data = {
                labels: ["Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli"],
                datasets: [{
                    label: "My First dataset",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(0,0,0,.15)",
                    data: [65, 59, 80, 81, 56, 55, 40],
                    backgroundColor: "#4CAF50"
                }, {
                    label: "My Second dataset",
                    fillColor: "rgba(255,255,255,.25)",
                    strokeColor: "rgba(255,255,255,.75)",
                    pointColor: "#fff",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(0,0,0,.15)",
                    data: [28, 48, 40, 19, 86, 27, 90]
                }]
            };

            var option = {
                responsive: true,
                // set font color
                scaleFontColor: "#fff",
                // font family
                defaultFontFamily: "'Roboto', sans-serif",
                // background grid lines color
                scaleGridLineColor: "rgba(255,255,255,.1)",
                // hide vertical lines
                scaleShowVerticalLines: false
            };

            // Get the context of the canvas element we want to select
            var ctx = document.getElementById("sales").getContext('2d');
            var myLineChart = new Chart(ctx).Line(data, option); //'Line' defines type of the chart.
        });
    </script>

    <script>
        // Data Picker Initialization
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
            hiddenPrefix: 'd'
        });


        // Material Select Initialization
        $(document).ready(function () {
            $('.mdb-select').material_select();
        });

        // Sidenav Initialization
        $(".button-collapse").sideNav();

        // Tooltips Initialization
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
            $('#toggle').tooltip('show')
        })
    </script>
@endsection