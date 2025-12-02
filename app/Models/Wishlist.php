<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wishlist extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'added_at',
    ];

    /**
     * Each wishlist item belongs to a user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Each wishlist item is linked to one car
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
