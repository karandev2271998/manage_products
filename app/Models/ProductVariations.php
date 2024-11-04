<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;
class ProductVariations extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'color',
        'prize',
        'size',
        'stock_quantity',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
