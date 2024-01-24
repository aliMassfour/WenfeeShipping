<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ProductException;
use App\Facades\Geocoding;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\ScanRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
        $destination = $request->city . "," . $request->state . "," . "Usa";
//        return json_encode($request->);
        $latlng = Geocoding::getLatLng($destination);
        $order = Order::query()->create([
            'buyer_name' => $request->buyerName,
            'buyer_phone' => $request->buyerPhone,
            'destination' => $destination,
            'city' => $request->city,
            'state' => $request->state,
            'products' => json_encode($request->products),
            'lat' => $latlng['lat'],
            'lng' => $latlng['lng']
        ]);
        return response()->json([
            'message' => 'order was created successfully'
        ]);

    }

    public function scan(Order $order, ScanRequest $request)
    {
        $code = $request->code;
        $products = collect(json_decode($order->products));
        $productKey = $products->search(function ($product) use ($code) {
            return $product->code == $code;
        });
//        return $productKey;
        if ($productKey === false) {
            throw ProductException::notFoundProduct();
        } else {
            $products[$productKey]->status = "checked";
            $order->products = $products;
            $order->save();
        }
        return response()->json([
            "message" => "product scanned successfully"
        ], 200);

    }

}
