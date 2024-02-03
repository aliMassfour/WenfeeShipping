<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ["paht", "order_id"];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, "order_id", 'id');
    }
}
