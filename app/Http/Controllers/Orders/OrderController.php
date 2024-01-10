<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $orders = Order::query()->whereDoesntHave('delivery')->get();
//        return $orders;
        return view('orders.index')->with("orders",$orders);
    }

}
