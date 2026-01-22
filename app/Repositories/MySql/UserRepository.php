<?php

namespace App\Repositories\MySql;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\MySql\BaseRepository;
use App\Repositories\Contracts\UserContract;

class UserRepository extends BaseRepository implements UserContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function update(Model $model, array $attributes = []): mixed
    {
        if (array_key_exists('password', $attributes) && empty($attributes['password'])) {
            unset($attributes['password']);
        }
        return parent::update($model, $attributes);
    }
}
