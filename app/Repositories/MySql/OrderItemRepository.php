<?php

namespace App\Repositories\MySql;

use App\Models\OrderItem;
use App\Repositories\Contracts\OrderItemContract;

class OrderItemRepository extends BaseRepository implements OrderItemContract
{
    public function __construct(OrderItem $model)
    {
        parent::__construct($model);
    }
}
