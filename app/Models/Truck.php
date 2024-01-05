<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Truck extends Model
{
    use HasFactory;

    protected $fillable = [
        "serial_number" ,
        "type"
    ];
    public function deliveries():HasMany
    {
        return $this->hasMany(\App\Models\Delivery::class,"truck_id","id");
    }


}
