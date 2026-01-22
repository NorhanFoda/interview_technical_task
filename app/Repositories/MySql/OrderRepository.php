<?php

namespace App\Repositories\MySql;

use App\Models\Order;
use App\Repositories\Contracts\OrderContract;

class OrderRepository extends BaseRepository implements OrderContract
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }
}
