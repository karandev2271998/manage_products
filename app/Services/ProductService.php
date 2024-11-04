<?php

namespace App\Services;

use App\Http\Resources\ProductResouce;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductMedia;

class ProductService
{
    public $getCurrentUserId;

    public function __construct()
    {
        $this->getCurrentUserId = Auth::user()->id;
    }

    public function index()
    {
        $getAllProducts = Product::where('user_id', $this->getCurrentUserId)->with('productVariations')->get();
        return  ProductResouce::collection($getAllProducts);
    }

    public function store($request)
    {
        try {
            $productMediaDetails = [];
            $createProduct = Product::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'description' => $request->description,
                'stock_quantity' => $request->stock_quantity,
                'price' => $request->price,
            ]);
            if ($createProduct) {
                foreach ($request->file('media') as $imageOrVideo) {
                    $uploadfileToStorage = $imageOrVideo->store('product-images-videos', 'public');
                    $productMediaDetails[] = [
                        'product_id' => $createProduct->id,
                        'product_media' => $uploadfileToStorage,
                    ];
                }
                ProductMedia::insert($productMediaDetails);
            }
            return new ProductResouce($createProduct);
        } catch (\Throwable $th) {
            return response()->json([
                'error' =>   $th->getMessage(),
            ]);
        }
    }

    public function show($productId)
    {
        try {
            return $this->getOrDeleteProduct($productId);
        } catch (\Throwable $th) {
            return response()->json([
                'error' =>   $th->getMessage(),
                'message' => "Requested product item could not be found."
            ]);
        }
    }

    public function deleteProduct($productId)
    {
        try {
            return $this->getOrDeleteProduct($productId, 'delete');
        } catch (\Throwable $th) {
            return response()->json([
                'error' =>   $th->getMessage(),
                'message' => "Requested product item could not be found."
            ]);
        }
    }

    public function update($productId, $request)
    {
        try {
            $getProduct = Product::where('user_id', $this->getCurrentUserId)->findOrFail($productId);
            if ($getProduct) {
                $getProduct->update($request->all());
                return new ProductResouce($getProduct);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error' =>   $th->getMessage(),
                'message' => "Requested product item could not be found."
            ]);
        }
    }

    public function getOrDeleteProduct($productId, $type = '')
    {
        $response['message'] = 'Requested item retrieved successfully.';
        $product = Product::where('user_id', $this->getCurrentUserId)->findOrFail($productId);
        if ($product) {
            $response['status'] = true;
            if ($type == 'delete') {
                $product->delete();
                $response['message'] = ' Requested Product deleted successfully';
                return response()->json($response, 200);
            }
            return new ProductResouce($product);
        }
    }
}
