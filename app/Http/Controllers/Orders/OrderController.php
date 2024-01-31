<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', "admin"]);
    }

    public function index($status)
    {
//        return $status;
        $query = Order::query();
        if ($status == "not_delivered") {
            $orders = $query->whereDoesntHave('delivery')->get();
        } elseif ($status == "delivered") {
            $orders = $query->where("status", "=", "delivered")->get();
        } else {
            $orders = $query->where("status", "=", "pending_delivery")->get();
        }


//        return $orders;
        return view('orders.index')->with("orders", $orders);
    }

}
