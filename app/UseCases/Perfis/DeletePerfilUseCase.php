<?php

namespace App\UseCases\Perfis;

use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Services\PermissionService;

class DeletePerfilUseCase
{
    public function __construct(
        private RoleRepository    $roleRepository,
        private PermissionService $permissionService,
        private UserRepository    $userRepository,
    )
    {
        $this->permissionService->createAllPermissions();
    }

    public function execute(int $role_id)
    {
        if ($this->userRepository->findCountByRole($role_id) > 0) {
            throw new \Exception('Existem usuários vinculados a este perfil.');
        }
        
        return $this->roleRepository->delete($role_id);
    }
}
