<?php

namespace App\Enums;

enum PermissionsEnum: string
{
    case USER_VIEW = 'users.view';
    case USER_CREATE = 'users.create';
    case USER_EDIT = 'users.edit';
    case USER_DELETE = 'users.delete';

    case ROLES_VIEW = 'roles.view';
    case ROLES_CREATE = 'roles.create';
    case ROLES_EDIT = 'roles.edit';
    case ROLES_DELETE = 'roles.delete';

    public function getGroupedFeature(): string
    {
        return match ($this) {
            self::USER_VIEW,
            self::USER_CREATE,
            self::USER_EDIT,
            self::USER_DELETE => 'User Management',
            self::ROLES_VIEW,
            self::ROLES_CREATE,
            self::ROLES_EDIT,
            self::ROLES_DELETE => 'Roles Management',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::USER_VIEW => 'View Users',
            self::USER_CREATE => 'Create User',
            self::USER_EDIT => 'Edit User',
            self::USER_DELETE => 'Delete User',
            self::ROLES_VIEW => 'View Roles',
            self::ROLES_CREATE => 'Create Role',
            self::ROLES_EDIT => 'Edit Role',
            self::ROLES_DELETE => 'Delete Role',
        };
    }
}
