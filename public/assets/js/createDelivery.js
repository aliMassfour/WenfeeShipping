document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("DOMContentLoaded", function () {
        let coordinates = [];

        function addOrder(orderId, lat, lng) {
            const orderIndex = coordinates.findIndex(order => order.id === orderId);

            if (orderIndex !== -1) {
                // Order is already in the array, remove it
                coordinates.splice(orderIndex, 1);
            } else {
                // Order is not in the array, add it
                coordinates.push({ id: orderId, lat: lat, lng: lng });
            }

            console.log(coordinates);
        }

        // Rest of your code...

    });

});

async function initMap() {
    const {Map} = await google.maps.importLibrary("maps");

    // Replace the following with your actual array of waypoints
    const waypoints = [
        {lat: 29.7604, lng: -95.3698}, // Example: Houston, TX
        // Add other waypoints as needed
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
        center: waypoints[0],
        zoom: 13
    });

    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(map);

    // Construct an array of LatLng objects from the waypoints
    const waypointLatLngs = waypoints.map(waypoint => new google.maps.LatLng(waypoint.lat, waypoint.lng));

    // Set the start and end points
    var start = waypointLatLngs[0];
    var end = waypointLatLngs[0];

    // Create waypoints excluding the start and end points
    var waypointsArray = waypointLatLngs.slice(1, -1).map(waypoint => ({location: waypoint, stopover: true}));

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


}

