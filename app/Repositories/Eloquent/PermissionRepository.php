<?php

namespace App\Repositories\Eloquent;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    public function __construct(private Permission $model)
    {
    }

    public function create(string $name)
    {
        $this->model->create($data);
    }

    public function findByName(string $name): ?Permission
    {
        return $this->model->where('name', $name)->first();
    }
}
