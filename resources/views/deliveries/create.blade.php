@extends("layouts.app")
@section("content")
        <form action="{{route("delivery.store",$order)}}" id="deliveryForm" method="POST">
            @csrf
            <div class="container-fluid py-4">
                <div class="row min-vh-80">
                    <h4>System say that this orders should be in the same delivery</h4>
                    @foreach($orders as $order )
                        <div class="col-lg-4 mb-lg-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="{{$order["id"]}}"
                                       name="orders[]"
                                       value="{{$order["id"]}}"
                                       onchange="addOrder('{{$order["id"]}}', {{$order["lat"]}}, {{$order["lng"]}})">

                                <label class="form-check-label"></label>
                            </div>
                            <div class="card" data-bs-toggle="modal" data-bs-target="#orderModal{{$order["id"]}}">
                                <div class="card-header border bg-gradient-dark"></div>
                                <div class="card-body">
                                    <h4 class="card-text">number: {{$order["number"]}}</h4>
                                    <h6 class="card-text">name: {{$order["buyer_name"]}}</h6>
                                    <h6 class="card-text">phone: {{$order["buyer_phone"]}}</h6>
                                </div>
                                <div class="card-footer border bg-gradient-dark">


                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="orderModal{{$order["id"]}}" tabindex="-1" role="dialog"
                             aria-labelledby="orderModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderModalLabel">Order Details</h5>
                                        <button type="button" class="btn-close btn-danger border-0"
                                                data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Name: {{$order["buyer_name"]}}</p>
                                        <p>Phone: {{$order["buyer_phone"]}}</p>
                                        <p>products :</p>
                                        <ul class="list-group">
                                            @foreach(json_decode($order["products"]) as $product)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{$product->name}}
                                                    <span
                                                        class="badge bg-gradient-dark rounded-pill">{{$product->amount}}</span>
                                                    <span class="badge bg-gradient-dark rounded-pill">{{$product->amount * $product->price}}$</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    @endforeach
                </div>
                <br>
                <div class="mb-3 mt-3">
                    <label for="drivers" class="form-label">select driver for this delivery</label>
                    <select name="driver" id="driver" class="form-select">
                        @foreach($drivers as $driver)
                            <option value="{{$driver->id}}">{{$driver->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="trucks" class="form-label">select truck for this delivery</label>
                    <select name="truck" id="truck" class="form-select">
                        @foreach($trucks as $truck)
                            <option value="{{$truck->id}}">
                                {{$truck->serial_number}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button onclick="initMap()" type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#submitDelivery">
                submit
            </button>

        </form>
        <div class="modal fade" id="submitDelivery">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"></div>
                    <div class="modal-body">
                        <div id="map" style="height: 400px;"></div>
                        <br class="breadcrumb-dark">
                        <p id="driverInModal"></p>
                        <p id="truckInModal"></p>
                        <button id="modalSubmitButton" type="button" class="btn btn-primary">
                            Submit
                        </button>

                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>

    <script>

        let coordinates = [];

        function addOrder(orderId, lat, lng) {
            const orderIndex = coordinates.findIndex(order => order.id === orderId);

            if (orderIndex !== -1) {
                // Order is already in the array, remove it
                coordinates.splice(orderIndex, 1);
            } else {
                // Order is not in the array, add it
                coordinates.push({id: orderId, lat: lat, lng: lng});
            }

            console.log(coordinates);
        }

        // Rest of your code...

        async function initMap() {

            const map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 40.7128, lng: -74.0060}, // New York City coordinates
                zoom: 13
            });

            // Replace the following with your actual array of waypoints
            const waypoints = coordinates.map(order => ({lat: order.lat, lng: order.lng}));

            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            // Construct an array of LatLng objects from the waypoints
            const waypointLatLngs = waypoints.map(waypoint => new google.maps.LatLng(waypoint.lat, waypoint.lng));

            // Set the start and end points to New York City coordinates
            var start = {
                lat: 40.7128,
                lng: -74.0060,
                label: 'A'
            };

            var end = {
                lat: 40.7128,
                lng: -74.0060,
                label: 'A'
            };

            // Create waypoints excluding the start and end points
            var waypointsArray = waypointLatLngs.slice().map(waypoint => ({location: waypoint, stopover: true}));
            var request = {
                origin: start,
                destination: end,
                waypoints: waypointsArray,
                optimizeWaypoints: true, // Optimize the order of waypoints for the shortest route
                travelMode: 'DRIVING'
            };

            directionsService.route(request, function (result, status) {
                if (status == 'OK') {
                    directionsRenderer.setDirections(result);
                }
            });
            // const selectedDriverId = document.getElementById('driver').value;
            // const selectedTruckId = document.getElementById('truck').value;
            const selectedDriverName = document.getElementById('driver').options[document.getElementById('driver').selectedIndex].text;
            const selectedTruckSerialNumber = document.getElementById('truck').options[document.getElementById('truck').selectedIndex].text;
            document.getElementById("driverInModal").innerText = "driver name is : " + selectedDriverName;
            document.getElementById("truckInModal").innerText = "truck serial number is : " + selectedTruckSerialNumber;
            const modalSubmitButton = document.getElementById('modalSubmitButton');
            modalSubmitButton.addEventListener('click', function () {
                // Submit the form when the modal submit button is clicked
                document.getElementById("deliveryForm").submit();
            });

        }


    </script>

@endsection
