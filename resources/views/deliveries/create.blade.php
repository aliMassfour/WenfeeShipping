@extends("layouts.app")
@section("content")
    @include("layouts.nav")
    <main class="main-content mt-lg-3 height-100% border-radius-lg border bg-body">
        <div class="container-fluid">
            <div class="row min-vh-80">
                <div id="map" class="small"></div>

            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initMap(
                {{$order->lat}},
                {{$order->lng}}
            );
        });

        async function initMap(endLat, endLng) {
            const { Map } = await google.maps.importLibrary("maps");

            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat:33.5226906,lng:35.8073717},
                zoom: 4
            });

            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            var start = new google.maps.LatLng(33.5226906, 35.8073717);
            var end = new google.maps.LatLng(endLat, endLng);

            var request = {
                origin: start,
                destination: end,
                travelMode: 'DRIVING'
            };

            directionsService.route(request, function (result, status) {
                if (status == 'OK') {
                    directionsRenderer.setDirections(result);
                }
            });
        }

    </script>

@endsection
