<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App\Api\V1\{
    CartController,
    OrderController
};

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('add-to-cart', [CartController::class, 'store']);
Route::post('remove-from-cart', [CartController::class, 'removeFromCart']);
Route::post('purchase', [OrderController::class, 'purchase']);