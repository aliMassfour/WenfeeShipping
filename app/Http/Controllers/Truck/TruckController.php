<?php

namespace App\Http\Controllers\Truck;

use App\Http\Controllers\Controller;
use App\Http\Requests\TruckRequest;
use App\Models\Delivery;
use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function index()
    {
        $truks = Truck::query()->paginate(5);
        $truks->each(function (Truck &$truck) {
            $deliveries = $truck->deliveries;
            if (sizeof($deliveries) > 0) {
                $deliveries->each(function (Delivery $delivery) use(&$truck) {
                    if ($delivery->status == "pending")
                    {
                        $truck->setAttribute("status","busy");
                    }else{
                        $truck->setAttribute('status',"available");
                    }
            });
            }
        });
        return view("trucks.index")->with("trucks",$truks);
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
