<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    protected $fillable = [
        'member_id',
        'user_id',
        'sale_date',
        'total_amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'sale_date' => 'datetime',
            'total_amount' => 'decimal:2',
        ];
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function soldProducts(): HasMany
    {
        return $this->hasMany(SoldProduct::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
