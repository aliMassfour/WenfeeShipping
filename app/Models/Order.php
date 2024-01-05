<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Testing\Fluent\Concerns\Has;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "products", "destination", "lat", "lng", "buyer_name", "buyer_phone", "delivery_id"
    ];
    /**
     * @return HasOne
    **/
    public function delivery():HasOne
    {
        return $this->hasOne(\App\Models\Delivery::class,"order_id","id");
    }

}
