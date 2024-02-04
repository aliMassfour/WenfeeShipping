<?php

namespace App\Http\Middleware;

use App\Models\Truck;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeliveryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $trucks = Truck::query()->whereDoesntHave("deliveries", function ($query) {
            $query->where("status", "=", "pending");
        });
        $drivers = User::query()->whereDoesntHave("deliveries", function ($query) {
            $query->where("status", "=", "pending");
        });
        if (sizeof($trucks->get()) == 0 || sizeof($drivers->get()) == 0) {
            return redirect()->back()->with([
                "message" => "you can't create delivery right now",
                "messageStatus" => 0
            ]);
        }
        return $next($request);
    }
}
