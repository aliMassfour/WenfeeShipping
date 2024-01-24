<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function index()
    {
        $trucks = Truck::query()->paginate(10);
        $trucks->each(function (Truck $truck) {
            $truck->setAttribute("status", "available");
            $deliveries = $truck->deliveries;
            $deliveries->each(function (Delivery $delivery) use (&$truck) {
                if ($delivery->status == "pending") {
                    $truck->status = "busy";
                }
            });
        });
        return view('trucks.index')->with('trucks',$trucks);
    }

    public function show(Truck $truck)
    {

    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function delete(Truck $truck)
    {

    }

    public function stop(Truck $truck)
    {

    }
}
