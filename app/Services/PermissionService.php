<?php

namespace App\Services;

use App\Enums\PermissionsEnum;
use App\Repositories\Eloquent\PermissionRepository;
use Illuminate\Support\Str;

class PermissionService
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function createAllPermissions(): void
    {
        foreach (PermissionsEnum::cases() as $permission) {
            if (!$this->permissionRepository->findByName($permission->value)) {
                $this->permissionRepository->create($permission->value);
            }
        }
    }

    public static function getFeatures(): array
    {
        $features = [];
        $permissions = PermissionsEnum::cases();

        foreach ($permissions as $permission) {
            $group = $permission->getGroupedFeature();

            if (!isset($features[$group])) {
                $features[$group] = [
                    'key' => Str::slug($group),
                    'label' => $group,
                    'permissions' => [],
                ];
            }

            $features[$group]['permissions'][] = [
                'key' => $permission->value,
                'label' => $permission->getLabel(),
            ];
        }

        return array_values($features);
    }


}
