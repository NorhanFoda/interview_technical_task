<?php

namespace App\Enums;

enum OrderType: string
{
    case ORDER = 'order';
    case CART = 'cart';

    public function label(): string
    {
        return match ($this) {
            self::ORDER => 'Order',
            self::CART => 'Cart',
        };
    }
}
