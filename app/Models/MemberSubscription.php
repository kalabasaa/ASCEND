<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MemberSubscription extends Model
{
    protected $fillable = [
        'member_id',
        'membership_plan_id',
        'start_date',
        'end_date',
        'amount',
        'status',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function membershipPlan(): BelongsTo
    {
        return $this->belongsTo(MembershipPlan::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'subscription_id');
    }
}