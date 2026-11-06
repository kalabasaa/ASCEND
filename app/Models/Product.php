<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'stock_quantity',
        'low_stock_threshold',
        'status',
    ];

    public function soldProducts(): HasMany
    {
        return $this->hasMany(SoldProduct::class);
    }
}