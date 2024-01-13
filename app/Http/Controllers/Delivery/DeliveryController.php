<?php

namespace App\Http\Controllers\Delivery;

use App\Clustering\DbscanAdapter\DbscanAdapter;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Truck;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DeliveryController extends Controller

{
    public function create(\App\Models\Order $order)
    {
//        fetch all available drivers
        $drivers = User::query()
            ->where("role_id", "=", "2")
            ->wheredoesntHave("deliveries", function ($query) {
                $query->where("status", "=", "pending");
            })
            ->get();

//      fetch all available trucks
        $truks = Truck::query()->wheredoesntHave("deliveries", function ($query) {
            $query->where("status", "=", "pending");
        })
            ->get();
//      fetch clustering orders
        $dbscan = new DbscanAdapter(0.5, 5);
        $orders = Order::query()->whereDoesntHave("delivery")->get();
        $dbscan->setOrder($order);
        $orderGroup = $dbscan->cluster($orders->toArray());

        return view("deliveries.create")
            ->with(['order' => $order, 'drivers' => $drivers, "trucks" => $truks, "orders" => $orderGroup]);
    }

    public function store(Request $request,\App\Models\Order $order)
    {
        dd($request->all());

    }
}
