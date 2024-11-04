<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductMediaController;
use App\Http\Controllers\ProductVariationsController;

Route::middleware('jwt')->group(function () {
    Route::get('user/profile', [JWTAuthController::class, 'getUser']);
    Route::post('logout', [JWTAuthController::class, 'logout']);
    Route::apiResource('products', ProductController::class);
    Route::get('get/product/media/{id}', [ProductMediaController::class, 'getProductGallery']);
    Route::post('update/product/media', [ProductMediaController::class, 'updateProductImage']);
    Route::apiResource('product/variations', ProductVariationsController::class);

});
require __DIR__.'/auth.php';