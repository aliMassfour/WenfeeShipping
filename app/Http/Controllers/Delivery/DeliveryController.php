<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function create(\App\Models\Order $order)
    {

        return view("deliveries.create")->with('order', $order);
    }

    public function store(\App\Models\Order $order)
    {
        $order->delivery()->create([

        ]);
    }
}
