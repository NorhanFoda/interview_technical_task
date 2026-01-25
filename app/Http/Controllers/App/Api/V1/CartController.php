<?php

namespace App\Http\Controllers\App\Api\V1;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\Cart\CartService;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\Api\AddToCartRequest;
use App\Http\Requests\App\Api\RemoveFromCartRequest;

class CartController extends Controller
{

    public function __construct(public CartService $cartService)
    {
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(AddToCartRequest $request)
    {
        try {
            $cart = $this->cartService->addToCart($request->validated());
            return response()->json(['message' => 'Product added to cart successfully', 'data' => $cart]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function removeFromCart(RemoveFromCartRequest $request)
    {
        try {
            $cart = $this->cartService->removeFromCart($request->validated());
            return response()->json(['message' => 'Product removed from cart successfully', 'data' => $cart]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //TODO:: Show cart details
    }
}
