<?php

namespace App\Http\Controllers;

use App\Models\ProductVariations;
use Illuminate\Http\Request;
use App\Services\ProductVariationsService;
use App\Http\Requests\StoreProductVariationsRequest;
class ProductVariationsController extends Controller
{
    public $productVariationsService;

    public function __construct()
    {
        $this->productVariationsService = new ProductVariationsService;
    }

    public function index(){
        return $this->productVariationsService->index();
    }

    public function store(StoreProductVariationsRequest $request){
        return $this->productVariationsService->store($request);
    }

    public function show($id){
        return $this->productVariationsService->show($id);
    }

    public function update(StoreProductVariationsRequest $request, $productId)
    {
        return $this->productVariationsService->update($productId,  $request);
    }

    public function destroy($id){
        return $this->productVariationsService->destroy($id);
    }
}
