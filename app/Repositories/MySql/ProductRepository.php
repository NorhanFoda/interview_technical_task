<?php

namespace App\Repositories\MySql;

use App\Models\Product;
use App\Repositories\Contracts\ProductContract;

class ProductRepository extends BaseRepository implements ProductContract
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
