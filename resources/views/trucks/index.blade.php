@extends('layouts.app')
@section("content")
    @include("layouts.nav")
    <main class="main-content ">
        <div class="container mt-3">
            <h2>Trucks</h2>
            <div class="row">
                <div class="col-lg-10">
                    {{$trucks->links()}}
                </div>
                <!-- Filter buttons -->
                <div class="mb-3 col-lg-2">
                    <button class="btn btn-primary" id="filterAvailable">Available</button>
                    <button class="btn btn-primary" id="filterBusy">Busy</button>
                    <button class="btn btn-primary" id="filterAll">All</button>
                </div>
            </div>

            <table class="table table-dark table-striped bg-gradient-dark" id="truckTable">
                <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Type</th>
                    <th>status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trucks as $truck)
                    <tr class="truck-row" data-status= {{$truck->status}}>
                        <td>{{$truck->serial_number}}</td>
                        <td>{{$truck->type}}</td>
                        <td>{{$truck->status}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Custom Pagination Links -->

        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <script>
        $(document).ready(function () {
            // Initialize DataTable with pagination


            // Your existing code for filtering trucks
            $("#filterAvailable").click(function () {
                filterTruck("available");
            });

            $("#filterBusy").click(function () {
                filterTruck("busy");
            });
            $("#filterAll").click(function () {
                filterTruck(null)
            });

            function filterTruck(status) {
                if (status != null) {
                    $('.truck-row').hide();
                    $(".truck-row[data-status='" + status + "']").show();
                } else {
                    $(".truck-row").show();
                }

            }


        });
    </script>
@endsection
