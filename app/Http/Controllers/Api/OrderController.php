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
    public function __construct()
    {

        $this->middleware(['auth:sanctum']);
    }

    /**
     * @OA\Post(
     *     path="/order/store",
     *     operationId="storeOrder",
     *     tags={"Order"},
     *     summary="Create a new order",
     *     description="Creates a new order with the provided information.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"products", "city", "state", "buyerName", "buyerPhone"},
     *             @OA\Property(property="products", type="array", @OA\Items(
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="price", type="number", format="float"),
     *                 @OA\Property(property="code", type="string"),
     *                 @OA\Property(property="amount", type="integer", format="int32"),
     *             )),
     *             @OA\Property(property="city", type="string"),
     *             @OA\Property(property="state", type="string"),
     *             @OA\Property(property="buyerName", type="string"),
     *             @OA\Property(property="buyerPhone", type="string"),
     *              @OA\Property(property="number", type="string"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Order was created successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *     ),
     *      security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */

    public function store(OrderRequest $request)
    {
//        return $request->city;
        $destination = $request->city . "," . $request->state . "," . "Usa";
//        return $destination;
        $latlng = Geocoding::getLatLng($destination);
//        return $latlng;
        $order = Order::query()->create([
            'buyer_name' => $request->buyerName,
            'buyer_phone' => $request->buyerPhone,
            'destination' => $destination,
            'city' => $request->city,
            'state' => $request->state,
            'products' => json_encode($request->products),
            'lat' => $latlng['lat'],
            'lng' => $latlng['lng'],
            "number" => $request->number
        ]);
        return response()->json([
            'message' => 'order was created successfully',
            'order' => $order
        ]);

    }

    /**
     * @OA\Post(
     *     path="/orders/scan/{order}",
     *     operationId="scanOrder",
     *     tags={"Order"},
     *     summary="Scan a product in an order",
     *     description="Scans a product in the specified order.",
     *     @OA\Parameter(
     *         name="order",
     *         in="path",
     *         required=true,
     *         description="ID of the order to scan the product in",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="code",
     *         in="query",
     *         required=true,
     *         description="Code of the product to scan",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"code"},
     *             @OA\Property(
     *                 property="code",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product scanned successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Product scanned successfully"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found in the order"
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */

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
