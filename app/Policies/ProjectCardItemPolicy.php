<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Repositories\Eloquent\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjectCardItemPolicy
{
    public function index(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::PROJECT_CARD_ITEM_VIEW->value);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::PROJECT_CARD_ITEM_CREATE->value);
    }

    public function store(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::PROJECT_CARD_ITEM_CREATE->value);
    }

    public function edit(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::PROJECT_CARD_ITEM_EDIT->value);
    }

    public function update(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::PROJECT_CARD_ITEM_EDIT->value);
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo(PermissionsEnum::PROJECT_CARD_ITEM_DELETE->value);
    }
}
