<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Testing\Fluent\Concerns\Has;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "number", "city", "state",
        "products", "destination", "lat", "lng", "buyer_name", "buyer_phone", "delivery_id",
        "status","street","buyer_email"
    ];

    /**
     * @return HasOne
     **/
    public function delivery(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Delivery::class, "delivery_id", "id");

    }
    public function images():HasMany
    {
        return $this->hasMany(Image::class,"order_id","id");
    }

}
