<?php

namespace App\Http\Controllers\Delivery;

use App\Clustering\DbscanAdapter\DbscanAdapter;
use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Truck;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller

{
    public function __construct()
    {
        $this->middleware(["auth", "admin"]);
    }

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
        $dbscan = new DbscanAdapter(0.6, 5);
        $orders = Order::query()->whereDoesntHave("delivery")->get();
        $dbscan->setOrder($order);
        $orderGroup = $dbscan->cluster($orders->toArray());

        return view("deliveries.create")
            ->with(['order' => $order, 'drivers' => $drivers, "trucks" => $truks, "orders" => $orderGroup]);
    }

    public function store(Request $request, \App\Models\Order $order)
    {
//        dd($request->all());
        $this->validate($request, [
            'orders' => ['array', ' required'],
            'orders.*' => 'required|numeric',
            'driver' => 'required|numeric',
            'truck' => 'required|numeric'
        ]);
        try {
            DB::beginTransaction();
            $delivery = Delivery::query()->create([
                'truck_id' => $request->truck,
                'driver_id' => $request->driver,

            ]);
            foreach ($request->orders as $orderId) {
                $order = Order::query()->where("id", '=', $orderId)->first();
                $order->delivery_id = $delivery->id;
                $order->status = "pending_delivery";
                $order->save();
            }
            DB::commit();
            return redirect()->route('home')->with(['message' => 'delivery created successfully', "messageStatus" => 1]);
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return redirect()->back()->with(['message' => "sorry...error happened", 'messageStatus' => 0]);
        }


    }

    public function edit(Delivery $delivery)
    {
        $drivers = User::query()
            ->where("role_id", "=", "2")
            ->wheredoesntHave("deliveries", function ($query) {
                $query->where("status", "=", "pending");
            })
            ->get();

//      fetch all available trucks
        $truks = Truck::query()->wheredoesntHave("deliveries", function ($query) {
            $query->where("status", "=", "pending");
        })->get();

        return view("deliveries.edit")
            ->with(['delivery' => $delivery, 'trucks' => $truks, 'drivers' => $drivers]);
    }

    public function update(Request $request, Delivery $delivery)
    {

    }

}
