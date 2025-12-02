<?php

namespace App\Models\Public;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    /**
     * Table name for clarity
     */
    protected $table = 'cars';

    /**
     * Mass assignable fields for frontend display
     */
    protected $fillable = [
        'make',
        'model',
        'price',
        'image',
        'status',
        'shipping_region',
        'description',
        'is_featured',
        'year',
        'color',
        'transmission',
    ];

    /**
     * Format price for readable output
     */
    public function formattedPrice(): string
    {
        return '$' . number_format($this->price, 2);
    }

    /**
     * Scope for featured cars (limit to 8)
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->take(8);
    }

    /**
     * Combine key details for a display title
     */
    public function displayTitle(): string
    {
        return "{$this->year} {$this->make} {$this->model}";
    }

    /**
     * Get full image URL for frontend rendering
     */
    public function getImageUrlAttribute(): string
    {
        return asset("storage/{$this->image}");
    }

    /**
     * Check if car is active and visible (optional status helper)
     */
    public function isVisible(): bool
    {
        return $this->status === 'available'; // or whatever status logic you're using
    }
}
