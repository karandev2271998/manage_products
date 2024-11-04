<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ProductMedia;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'description',
        'price',
        'media',
        'stock_quantity'
    ];

    public function productVariations(): HasMany
    {
        return $this->hasMany(ProductVariations::class);
    }

    public function productGallery(): HasMany
    {
        return $this->hasMany(ProductMedia::class);
    }

}
