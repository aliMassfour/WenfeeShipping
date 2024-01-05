<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware([])->group(function(){
    Route::post('order/store',[\App\Http\Controllers\Api\OrderController::class,'store']);
});
Route::get('test', function () {
    $api_key = env('GOOGLE_MAP_KEY');
    $client = new \GuzzleHttp\Client();
    $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json', [
        'query' => [
            'address' => 'ss',
            'key' => $api_key
        ]
    ]);
    if(empty(json_decode($response->getBody())->results))
    {
        return "dddd";
    }


});
