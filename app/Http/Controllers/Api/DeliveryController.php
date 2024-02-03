<?php

namespace App\Http\Controllers\Api;

use App\Facades\StoreFile;
use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Image;
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

    public function storeDeliveryFiles(Request $request, Order $order)
    {
        $this->validate($request, [
            "files" => ["array", "required"],we
            "files.*" => ['required']
        ]);
        $files = $request->file("files");
        $paths = collect([]);
        foreach ($files as $file) {
            $paths->add([StoreFile::store($file, $order->id), $order->id]);
        }
        Order::query()->insert($paths->toArray());
        return response()->json([
            "message" => "added the file successfully"
        ]);


    }


}
