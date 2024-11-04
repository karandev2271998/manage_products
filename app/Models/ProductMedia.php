<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;

class ProductMedia extends Model
{
    protected $fillable = [
        'product_id',
        'product_media'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProductUserId()
    {
        return $this->product->user_id;
    }

    protected $hidden = ['product'];
    public $timestamps = false;
}
