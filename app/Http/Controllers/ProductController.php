<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\StoreProductItemRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public $productService;

    public function __construct()
    {
        $this->productService = new ProductService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->productService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductItemRequest $request)
    {
        return $this->productService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($productId)
    {
        return $this->productService->show($productId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $productId)
    {
        return $this->productService->update($productId,  $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productId)
    {
        return $this->productService->deleteProduct($productId);
    }
}
