<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DeliveryController extends Controller
{
    public function create(\App\Models\Order $order)
    {
        $drivers = User::query()->where("role_id", '2')->with('deliveries')->get();
        $returned_drivers=new Collection();
        foreach ($drivers as $driver)
        {
            $t=true;
            if(empty($driver->deliveries ))
            {
                $returned_drivers->add($driver);
                continue;
            }
            foreach ($driver->deliveries as $delivery)
            {
                if($delivery->status== "pending"){
                    $t=false;
                    break;
                }
            }
            if($t==true)
            {
                $returned_drivers->add($driver);

            }
        }

//        return $returned_drivers;
        return view("deliveries.create")->with(['order' => $order, 'drivers' => $returned_drivers]);
    }

    public function store(\App\Models\Order $order)
    {
        $order->delivery()->create([

        ]);
    }
}
