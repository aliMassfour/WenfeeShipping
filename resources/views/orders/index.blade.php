@extends('layouts.app')
@section("content")
    @include("layouts.nav")
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg bg-body">
        <div class="container-fluid py-4 ">
            <div class="row min-vh-80">
                @foreach($orders as $order)
                    <div class="col-lg-4 mb-lg-2">
                        <div class="card" data-bs-toggle="modal" data-bs-target="#orderModal{{$order->id}}">
                            <div class="card-header border bg-gradient-dark"></div>
                            <div class="card-body">
                                <h6 class="card-text">name: {{$order->buyer_name}}</h6>
                                <h6 class="card-text">phone: {{$order->buyer_phone}}</h6>
                            </div>
                            <div class="card-footer border bg-gradient-dark"></div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="orderModal{{$order->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="orderModalLabel" aria-hidden="true">
                        <div class="modal-dialog " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderModalLabel">Order Details</h5>
                                    <button type="button" class="btn-close btn-danger border-0" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Add order details here -->
                                    <p>Name: {{$order->buyer_name}}</p>
                                    <p>Phone: {{$order->buyer_phone}}</p>
                                    <p>products :</p>
                                    <ul class="list-group">
                                        @foreach(json_decode($order->products) as $product)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{$product->name}}
                                                <span class="badge bg-gradient-dark rounded-pill">{{$product->amount}}</span>
                                                <span class="badge bg-gradient-dark rounded-pill">{{$product->amount * $product->price}}$</span>
                                            </li>
                                        @endforeach


                                    </ul>

                                </div>
                                <div class="modal-footer">
                                    <a href="{{route('delivery.create',$order->id)}}" class="btn bg-gradient-dark"> make delivery</a>
                                    <button type="button" class="btn bg-gradient-dark" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                @endforeach
            </div>
        </div>
    </main>
@endsection
