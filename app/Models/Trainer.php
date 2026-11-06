<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trainer extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'specialization',
        'status',
    ];

    public function membershipPlans(): HasMany
    {
        return $this->hasMany(MembershipPlan::class);
    }
}