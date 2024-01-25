<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function show(Delivery $delivery)
    {
        $orders = $delivery->orders;
        $orders->each(function (Order &$order) {
            $order->products = json_decode($order->products);
        });
        $delivery->makeHidden('orders');
        return response()->json([
            'delivery' => $delivery,
            'orders' => $orders
        ]);
    }


}
