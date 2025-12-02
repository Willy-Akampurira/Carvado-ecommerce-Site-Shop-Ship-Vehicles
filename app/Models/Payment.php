<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'payment_reference',
        'method',
        'amount_paid',
        'status',
        'transaction_id',
        'paid_at',
    ];

    /**
     * Each payment belongs to one order.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Accessor to format the payment reference for display.
     */
    public function getFormattedReferenceAttribute(): string
    {
        return 'TXN-' . strtoupper($this->payment_reference);
    }

    /**
     * Scope to fetch only completed payments.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
