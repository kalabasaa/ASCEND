<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GymVisit extends Model
{
    protected $fillable = [
        'member_id',
        'check_in',
    ];

    protected function casts(): array
    {
        return [
            'check_in' => 'datetime',
        ];
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}