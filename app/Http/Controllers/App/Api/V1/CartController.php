<?php

namespace App\Http\Controllers\App\Api\V1;

use Illuminate\Http\Request;
use App\Services\Cart\CartService;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\Api\CartRequest;

class CartController extends Controller
{

    public function __construct(public CartService $cartService)
    {
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $request)
    {
        $this->cartService->addToCart($request->validated());
        return response()->json(['message' => 'Product added to cart successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
