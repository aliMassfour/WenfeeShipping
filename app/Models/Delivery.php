<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        "driver_id",
        "truck_id",
        'truck_dashboard',
        "status",
        "delivered_products"
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(\App\Models\Order::class, "delivery_id", "id");
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, "driver_id", "id");
    }

    public function truck(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Truck::class, "truck_id", "id");
    }
}
