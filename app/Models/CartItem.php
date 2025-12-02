<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'car_id',
        'quantity',
    ];
    /**
     * Relationship: Each cart item belongs to one user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Relationship: Each cart item is linked to one car.
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
