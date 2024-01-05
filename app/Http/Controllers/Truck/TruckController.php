<?php

namespace App\Http\Controllers\Truck;

use App\Http\Controllers\Controller;
use App\Http\Requests\TruckRequest;
use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
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
