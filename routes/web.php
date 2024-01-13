<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {


    return redirect()->route("login");
});
Route::get('login', [\App\Http\Controllers\Auth\AuthController::class, 'loginView'])->name('login');
Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login.store');
Route::post('logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');
Route::get('home', [\App\Http\Controllers\Home\HomeController::class, 'home'])->name('home');
Route::get('test', function () {
    return \App\Facades\Geocoding::getLatLng('latakia,Tishreen university   ');

});
//orders group
Route::middleware([])->group(function () {
    Route::get("orders", [\App\Http\Controllers\Orders\OrderController::class, "index"])->name("orders.index");
});
//end orders group


//deliveries group
Route::middleware([])->group(function () {
    Route::get("delivery/create/{order}", [\App\Http\Controllers\Delivery\DeliveryController::class, "create"])->name("delivery.create");
    Route::post("delivery/store/{order}", [\App\Http\Controllers\Delivery\DeliveryController::class, "store"])->name("delivery.store");
});

Route::get("test", function () {

});
