<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariationsResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response = [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'color' => $this->color,
            'prize' => $this->prize,
            'size' => $this->size,
            'stock_quantity' => $this->stock_quantity,
            'product' => [
                'id' => $this->product->id,
                'name' => $this->product->name,
                'description' => $this->product->description,
                'price' => $this->product->price,
                'stock_quantity' => $this->product->stock_quantity,
            ],
            'product_media' => $this->product->productGallery
        ];
        return $response;
    }
}
