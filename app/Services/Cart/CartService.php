<?php

namespace App\Services\Cart;

use App\Models\Order;
use App\Models\Product;
use App\Enums\OrderType;
use App\Enums\OrderStatus;
use App\Jobs\CartEmptyJob;
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
        return DB::transaction(function () use ($data) {
            try {
                $product = $this->productContract->find($data['product_id']);
                $cart = $this->getCart(userId: $data['user_id']);
                $cart = $this->addItemToCart($cart, $product, $data['quantity']);
                $cart = $this->updateTotalAmount($cart);
                dispatch(new CartUpdatedJob($cart));
                return $cart;
            } catch (\Exception $e) {
                throw $e;
            }
        });
    }
    public function removeFromCart(array $data)
    {
        return DB::transaction(function () use ($data) {
            try {
                $cart = $this->getCart(cartId: $data['cart_id']);
                $cartItem = $cart->items()
                    ->where('product_id', $data['product_id'])
                    ->lockForUpdate()
                    ->first();

                if ($cartItem) {
                    $cartItem->delete();
                }

                $cart->refresh();

                if ($cart->items->isEmpty()) {
                    $this->orderContract->remove($cart);
                    dispatch(new CartEmptyJob());
                    return null;
                }

                $cart = $this->updateTotalAmount($cart);
                dispatch(new CartUpdatedJob($cart));
                return $cart;
            } catch (\Exception $e) {
                throw $e;
            }
        });
    }

    public function getCart(?int $userId = null, ?int $cartId = null): Order
    {
        if ($userId) {
            return $this->getUserCart($userId);
        }

        if ($cartId) {
            return $this->getCartById($cartId);
        }

        throw new \Exception('Cart not found');
    }

    public function getUserCart(int $userId): Order
    {
        return $this->orderContract->findBy('user_id', $userId, false) ?? $this->orderContract->create([
            'user_id' => $userId,
            'total_amount' => 0,
            'type' => OrderType::CART->value,
            'status' => OrderStatus::PENDING->value,
        ]);
    }

    public function getCartById(int $cartId): Order
    {
        return $this->orderContract->find($cartId, ['items']);
    }

    public function addItemToCart(Order $cart, Product $product, int $quantity): Order
    {
        $cartItem = $cart->items()
            ->where('product_id', $product->id)
            ->lockForUpdate()
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $quantity,
            ]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity'   => $quantity,
                'price'      => $product->price,
            ]);
        }

        return $cart->refresh();
    }

    public function updateTotalAmount(Order $cart): Order
    {
        $cart->update(['total_amount' => array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], $cart->items->toArray()))]);
        return $cart->refresh();
    }
}
