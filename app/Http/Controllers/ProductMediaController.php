<?php

namespace App\Http\Controllers;

use App\Models\ProductMedia;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProductMediaRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
class ProductMediaController extends Controller
{
    public function getProductGallery($productId)
    {
        try {
            $response = [
                'status' => false,
                'message' => 'Request product id media not available'
            ];
            $getProductGallery = ProductMedia::whereProductId($productId)->get();
            if ($getProductGallery->isNotEmpty() && $getProductGallery[0]->getProductUserId() == Auth::user()->id) {
                $response = [
                    'status' => true,
                    'message' => 'Requested item retrieved successfully.',
                    'data' => $getProductGallery
                ];
                return response()->json($response, 200);
            }
            return response()->json($response, 404);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function updateProductImage(UpdateProductMediaRequest $request)
    {
        $productId = $request->product_id;
        $productMediaDetails = [];
        try {
            // Delete existing files and records
            $existingProductMedia = ProductMedia::whereProductId($productId)->pluck('product_media')->toArray();
            Storage::disk('public')->delete($existingProductMedia);
            ProductMedia::whereProductId($productId)->delete();

            // Upload and save new media
            $productMediaDetails = array_map(function ($media) use ($productId) {
                return [
                    'product_id' => $productId,
                    'product_media' => $media->store('product-images-videos', 'public'),
                ];
            }, $request->file('product_media'));

            ProductMedia::insert($productMediaDetails);

            return response()->json([
                'status' => true,
                'message' => 'Product media updated successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
