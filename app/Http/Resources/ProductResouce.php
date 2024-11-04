<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductResouce extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
        ];
        if (count($this->productGallery) > 0) {
            $response['product_image_or_video_gallery'] = $this->productGallery;
        }
        if (count($this->productVariations) > 0) {
            $response['variations'] = $this->productVariations;
        }
        return $response;
    }
}
