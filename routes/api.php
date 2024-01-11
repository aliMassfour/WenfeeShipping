<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \PHPUnit\Framework\TestCase;

/*
|--
------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Authentication group
Route::middleware([])->group(function () {
    Route::post("login", [\App\Http\Controllers\Api\Auth\AuthController::class, "login"]);
    Route::post("logout", [\App\Http\Controllers\Api\Auth\AuthController::class, "logout"]);
});


// orders group
Route::middleware([])->group(function () {
    Route::post('order/store', [\App\Http\Controllers\Api\OrderController::class, 'store']);
});
Route::get('test', function () {

//    $api_key = env('GOOGLE_MAP_KEY');
//    $client = new \GuzzleHttp\Client();
//    $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json', [
//        'query' => [
//            'address' => 'ss',
//            'key' => $api_key
//        ]
//    ]);
//    if(empty(json_decode($response->getBody())->results))
//    {
//        return "dddd";
//    }

//    $orders=  \App\Models\Order::query()->whereDoesntHave("delivery")->get();
//    $order = $orders->first();
//    $dbscan = new \Phpml\Clustering\DBSCAN($epsilon = 1, $minSamples = 5);
//    $samples = array();
//    foreach ($orders as $order)
//    {
//        $samples[]=[$order->lat , $order->lng];
//
//    }


//    $clustringCollection = collect(  $dbscan->cluster($samples));
//    return $clustringCollection;
//    return $collection;
    $orders = \App\Models\Order::query()->whereDoesntHave('delivery')->get();
    $order = $orders->first();
    $dbscan = new App\Clustering\DbscanAdapter\DbscanAdapter(1.0, 5);
    $dbscan->setOrder($order);

    return $dbscan->cluster($orders->toArray());
});
