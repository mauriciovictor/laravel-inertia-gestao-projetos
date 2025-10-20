<?php

namespace App\UseCases\Perfis;

use App\Repositories\Eloquent\RoleRepository;
use App\Services\PermissionService;

class DeletePerfilUseCase
{
    public function __construct(private RoleRepository $roleRepository, private PermissionService $permissionService)
    {
        $this->permissionService->createAllPermissions();
    }

    public function execute(int $role_id)
    {
        return $this->roleRepository->delete($role_id);
    }
}
