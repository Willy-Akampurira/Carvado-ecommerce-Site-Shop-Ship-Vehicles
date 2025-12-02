<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    //Mass assignable fields
    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'notes',
        'total_price',
    ];

    /**
     * Each order belongs to a user (customer)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Each order may have multiple related order items
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Scope to fetch only orders with 'pending' status.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Accessor to format the order number with a custom prefix
     */
    public function getFormatOrderNumberAttribute(): string
    {
        return 'ORD-' . str_pad($this->order_number, 6, '0', STR_PAD_LEFT);
    }
}
