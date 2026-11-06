<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'payment_type',
        'subscription_id',
        'sale_id',
        'amount',
        'payment_method',
        'payment_date',
        'reference_number',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'payment_date' => 'date',
        ];
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(MemberSubscription::class, 'subscription_id');
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }
}