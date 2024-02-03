@extends('layouts.app')
@section('content')
    <main class="main-content">
        <div class="container mt-3">
            <h2>Drivers</h2>
            <div class="row">
                <div class="col-lg-10">
                    {{$users->links()}}
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="user-row" data-status= {{$user->status}}>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->status}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Custom Pagination Links -->

        </div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

        <script>
            $(document).ready(function () {
                // Initialize DataTable with pagination


                // Your existing code for filtering trucks
                $("#filterAvailable").click(function () {
                    filterUser("available");
                });

                $("#filterBusy").click(function () {
                    filterUser("busy");
                });
                $("#filterAll").click(function () {
                    filterUser(null)
                });

                function filterUser(status) {
                    if (status != null) {
                        $('.user-row').hide();
                        $(".user-row[data-status='" + status + "']").show();
                    } else {
                        $(".user-row").show();
                    }

                }


            });
        </script>
    </main>
@endsection
