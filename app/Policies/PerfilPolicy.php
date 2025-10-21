<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Repositories\Eloquent\Models\User;
use Illuminate\Support\Facades\Auth;

class PerfilPolicy
{
    public function index(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::ROLES_VIEW->value);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::ROLES_CREATE->value);
    }

    public function store(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::ROLES_CREATE->value);
    }

    public function edit(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::ROLES_EDIT->value);
    }

    public function update(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::ROLES_EDIT->value);
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::ROLES_DELETE->value);
    }
}
