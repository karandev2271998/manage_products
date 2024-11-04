<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductVariations;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductVariationsResouce;


class ProductVariationsService
{
    public $getCurrentUserId;

    public function __construct()
    {
        $this->getCurrentUserId = Auth::user()->id;
    }

    public function index(){
        $getProductVariations = ProductVariations::where('user_id', $this->getCurrentUserId)->with('product')->get();
        return  ProductVariationsResouce::collection($getProductVariations);
    }

    public function store($request){
        try {
            $createProduct = ProductVariations::create([
                'product_id' => $request->product_id,
                'user_id' => Auth::user()->id,
                'color' => $request->color,
                'prize' => $request->prize,
                'size' => $request->size,
                'stock_quantity' => $request->stock_quantity,
            ]);
            return new ProductVariationsResouce($createProduct);
        } catch (\Throwable $th) {
            return response()->json([
                'error' =>   $th->getMessage(),
            ]);
        }
    }


    public function show($productId)
    {
        try {
            return $this->getOrDeleteProductVariation($productId);
        } catch (\Throwable $th) {
            return response()->json([
                'error' =>   $th->getMessage(),
                'message' => "Requested product variation item could not be found."
            ]);
        }
    }
    
    public function update($productId, $request)
    {
        try {
            $getProductVariations = ProductVariations::where('user_id', $this->getCurrentUserId)->findOrFail($productId);
            if ($getProductVariations) {
                $getProductVariations->update($request->all());
                return new ProductVariationsResouce($getProductVariations);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error' =>   $th->getMessage(),
                'message' => "Requested product variation item could not be found."
            ]);
        }
    }

    public function destroy($productVariationId){
        try {
            return $this->getOrDeleteProductVariation($productVariationId, 'delete');
        } catch (\Throwable $th) {
            return response()->json([
                'error' =>   $th->getMessage(),
                'message' => "Requested product item could not be found."
            ]);
        }
    }

    public function getOrDeleteProductVariation($productVariationId, $type = '')
    {
        $response['message'] = 'Requested product variation item retrieved successfully.';
        $product = ProductVariations::where('user_id', $this->getCurrentUserId)->findOrFail($productVariationId);
        if ($product) {
            $response['status'] = true;
            if ($type == 'delete') {
                $product->delete();
                $response['message'] = ' Requested Product variation item deleted successfully';
                return response()->json($response, 200);
            }
            return new ProductVariationsResouce($product);
        }
    }
}
