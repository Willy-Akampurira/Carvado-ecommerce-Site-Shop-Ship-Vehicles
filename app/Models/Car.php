<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'make',
        'model',
        'year',
        'mileage',
        'color',
        'transmission',
        'fuel_type',
        'vin',
        'image',
        'price',
        'category', // ✅ Used for filtering
    ];

    /**
     * Get all wishlist entries that include this car.
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
