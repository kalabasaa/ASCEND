<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    protected $fillable = [
        'member_id',
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'address',
        'gender',
    ];

    protected static function booted(): void
    {
        static::created(function (Member $member) {
            $member->saveQuietly(['member_id' => 'ASC-' . $member->id]);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(MemberSubscription::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function gymVisits(): HasMany
    {
        return $this->hasMany(GymVisit::class);
    }
}