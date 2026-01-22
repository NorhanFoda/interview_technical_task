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

    public function create(array $attributes = []): mixed
    {
        $user = parent::create($attributes);
        if (isset($attributes['role'])) {
            $user->syncRoles([$attributes['role']]);
        }
        return $user;
    }

    public function update(Model $model, array $attributes = []): mixed
    {
        if (array_key_exists('password', $attributes) && empty($attributes['password'])) {
            unset($attributes['password']);
        }
        $user = parent::update($model, $attributes);
        if (isset($attributes['role'])) {
            $user->syncRoles([$attributes['role']]);
        }
        return $user;
    }
}
