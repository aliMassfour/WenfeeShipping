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
    Route::patch("orders/scan/{order}", [\App\Http\Controllers\Api\OrderController::class, 'scan']);
});
Route::middleware([])->group(function () {
    Route::get('delivery/{delivery}', [\App\Http\Controllers\Api\DeliveryController::class, "show"]);
});

Route::post('test', function (Request $request) {
    return \App\Facades\StoreFile::store($request->file("file"), 1);
});
