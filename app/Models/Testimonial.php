<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    // Enable mass assignment for these fields
    protected $fillable = [
        'name',
        'photo',
        'text',
        'rating', // ✅ Added to allow saving user rating
    ];

    // Cast fields to appropriate types
    protected $casts = [
        'rating' => 'integer',       // ✅ Ensures consistent numeric type
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
