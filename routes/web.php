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
Route::get('home', [\App\Http\Controllers\Home\HomeController::class, "home"])->name('home');
Route::get('login', [\App\Http\Controllers\Auth\AuthController::class, 'loginView'])->name('login');
Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login.store');
Route::post('logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');
Route::get('home', [\App\Http\Controllers\Home\HomeController::class, 'home'])->name('home');
Route::get('test', function () {
    return \App\Facades\Geocoding::getLatLng('latakia,Tishreen university   ');

});
//orders group
Route::middleware([])->group(function () {
    Route::get("orders/{status}", [\App\Http\Controllers\Orders\OrderController::class, "index"])->name("orders.index");
});
//end orders group


//deliveries group
Route::middleware([])->group(function () {
    Route::get("delivery/create/{order}", [\App\Http\Controllers\Delivery\DeliveryController::class, "create"])->name("delivery.create");
    Route::post("delivery/store/{order}", [\App\Http\Controllers\Delivery\DeliveryController::class, "store"])->name("delivery.store");
});

Route::middleware([])->group(function () {
    Route::get("trucks", [\App\Http\Controllers\Truck\TruckController::class, "index"])->name("trucks.index");
    Route::get("trucks/{truck}", [\App\Http\Controllers\Truck\TruckController::class, "show"])->name("trucks.show");
    Route::get("truck/create", [\App\Http\Controllers\Truck\TruckController::class, "create"])->name("trucks.create");
    Route::post("truck/store", [\App\Http\Controllers\Truck\TruckController::class, "store"])->name("trucks.store");

});
//users routes
Route::middleware([])->group(function () {
    Route::get("users", [\App\Http\Controllers\User\UserController::class, "index"])->name('users.index');
    Route::get('users/create', [\App\Http\Controllers\User\UserController::class, "create"])->name('users.create');
    Route::post("users/store",[\App\Http\Controllers\User\UserController::class,"store"])->name("users.store");
});
Route::get("test", function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Mail::raw("hello this is test email", function ($message) {
        $message->to("hghf00680@gmail.com")->subject("test");
    });

});
