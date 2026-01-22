<?php

namespace App\Repositories\MySql;

use App\Models\Role;
use App\Repositories\Contracts\RoleContract;
use Illuminate\Database\Eloquent\Model;

class RoleRepository extends BaseRepository implements RoleContract
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes = []): mixed
    {
        $role = parent::create($attributes);
        if (isset($attributes['permissions'])) {
            $role->syncPermissions($attributes['permissions']);
        }
        return $role;
    }

    public function update(Model $model, array $attributes = []): mixed
    {
        $role = parent::update($model, $attributes);
        if (isset($attributes['permissions'])) {
            $role->syncPermissions($attributes['permissions']);
        }
        return $role;
    }
}
