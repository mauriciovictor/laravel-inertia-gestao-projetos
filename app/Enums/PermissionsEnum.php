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

    case PROJECT_VIEW = 'projects.view';
    case PROJECT_CREATE = 'projects.create';
    case PROJECT_EDIT = 'projects.edit';
    case PROJECT_DELETE = 'projects.delete';
    case PROJECT_CARD_VIEW = 'projects_cards.view';
    case PROJECT_CARD_CREATE = 'projects_cards.create';
    case PROJECT_CARD_EDIT = 'projects_cards.edit';
    case PROJECT_CARD_DELETE = 'projects_cards.delete';

    case PROJECT_CARD_ITEM_VIEW = 'projects_cards_items.view';
    case PROJECT_CARD_ITEM_CREATE = 'projects_cards_items.create';
    case PROJECT_CARD_ITEM_EDIT = 'projects_cards_items.edit';
    case PROJECT_CARD_ITEM_DELETE = 'projects_cards_items.delete';

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
            self::PROJECT_VIEW,
            self::PROJECT_CREATE,
            self::PROJECT_EDIT,
            self::PROJECT_DELETE => 'Project Management',
            self::PROJECT_CARD_VIEW,
            self::PROJECT_CARD_CREATE,
            self::PROJECT_CARD_EDIT,
            self::PROJECT_CARD_DELETE => 'Project Cards Management',
            self::PROJECT_CARD_ITEM_VIEW,
            self::PROJECT_CARD_ITEM_CREATE,
            self::PROJECT_CARD_ITEM_EDIT,
            self::PROJECT_CARD_ITEM_DELETE => 'Project Card Items Management',
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
            self::PROJECT_VIEW => 'View Projects',
            self::PROJECT_CREATE => 'Create Project',
            self::PROJECT_EDIT => 'Edit Project',
            self::PROJECT_DELETE => 'Delete Project',
            self::PROJECT_CARD_VIEW => 'View Project Cards',
            self::PROJECT_CARD_CREATE => 'Create Project Card',
            self::PROJECT_CARD_EDIT => 'Edit Project Card',
            self::PROJECT_CARD_DELETE => 'Delete Project Card',
            self::PROJECT_CARD_ITEM_VIEW => 'View Project Card Items',
            self::PROJECT_CARD_ITEM_CREATE => 'Create Project Card Item',
            self::PROJECT_CARD_ITEM_EDIT => 'Edit Project Card Item',
            self::PROJECT_CARD_ITEM_DELETE => 'Delete Project Card Item',
        };
    }
}
