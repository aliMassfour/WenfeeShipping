<?php

namespace App\Http\Controllers\Truck;

use App\Http\Controllers\Controller;
use App\Http\Requests\TruckRequest;
use App\Models\Delivery;
use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth", "admin"]);
    }

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
        return view('trucks.index')->with('trucks', $trucks);
    }

    public function store(TruckRequest $request)
    {
        $truck = Truck::query()->create([
            'serial_number' => $request->serial_number,
            'type' => $request->type
        ]);
        return redirect()->back()->with("message", "truck created successfully");
    }

    public function update(TruckRequest $request, Truck $truck)
    {
        $truck->serial_number = $request->serial_number;
        $truck->type = $request->type;
        return redirect()->back()->with("message", "truck updated successfully");

    }

    public function destroy(Truck $truck)
    {
        $truck->delete();
        return redirect()->back()->with("message", "truck deleted successfully");
    }
}
