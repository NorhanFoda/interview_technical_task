<?php

namespace App\Services\Cart;

use App\Enums\OrderType;
use App\Enums\OrderStatus;
use App\Jobs\AddToCartJob;
use App\Jobs\CartUpdatedJob;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\UserContract;
use App\Repositories\Contracts\OrderContract;
use App\Repositories\Contracts\ProductContract;

class CartService
{
    public function __construct(public ProductContract $productContract, public OrderContract $orderContract, public UserContract $userContract) {}
    public function addToCart(array $data)
    {
        DB::transaction(function () use ($data) {
            try {
                $product = $this->productContract->find($data['product_id']);
                $cart = $this->userContract->find($data['user_id'], ['cart', 'cart.items']);
                $cart = $cart->cart ?? $this->orderContract->create([
                    'user_id' => $data['user_id'],
                    'total_amount' => 0,
                    'type' => OrderType::CART->value,
                    'status' => OrderStatus::PENDING->value,
                ]);
                $cart->items()->updateOrCreate([
                    'order_id' => $cart->id,
                    'product_id' => $data['product_id'],
                ], [
                    'quantity' => $data['quantity'],
                    'price' => $product->price,
                ]);
                $cart->refresh();
                $cart->update(['total_amount' => array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart->items->toArray()))]);
                dispatch(new CartUpdatedJob($cart));
            } catch (\Exception $e) {
                throw $e;
            }
        });
    }
}
