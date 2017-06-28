@extends('layouts.app')

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div id="map-container" style="height:750px"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyBuZzjWJDbh-cbck1tK5Wu5G_Z78AWuRw4"></script>
    <script>
        function init_map() {
            var var_location = new google.maps.LatLng(53.0360185, 6.304707);

            var var_mapoptions = {
                center: var_location,
                zoom: 14
            };

            var var_map = new google.maps.Map(document.getElementById("map-container"),
                var_mapoptions);

            var contentString = '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                '<h1 id="firstHeading" class="firstHeading">Jansma Boerenproducten</h1>'+
                '<div id="bodyContent">'+
                '<p>Dorpstraat 56 <br />' +
                '8432 PD Haule <br />' +
                '<p>Tel: 0516-577358 <br />' +
                'Fax: 0516-577444 <br />' +
                'Email:  <a href="mailto:jansma.haule&#64;gmail.com">jansma.haule&#64;gmail.com</a>' +
                '</div>'+
                '</div>';

            var var_infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            var var_marker = new google.maps.Marker({
                position: var_location,
                map: var_map,
                title: "Jansma Boerenproducten"
            });


//            var_map.addListener('center_changed', function() {
//                // 3 seconds after the center of the map has changed, pan back to the
//                // marker.
//                window.setTimeout(function() {
//                    var_map.panTo(var_marker.getPosition());
//                }, 3000);
//            });


            var_marker.addListener('click', function() {
                var_map.setZoom(14);
                var_map.setCenter(var_marker.getPosition());
                var_infowindow.open(var_map, var_marker);
            });

            var_marker.setMap(var_map);
            var_infowindow.open(var_map, var_marker);

        }
        google.maps.event.addDomListener(window, 'load', init_map);
    </script>
@endsection