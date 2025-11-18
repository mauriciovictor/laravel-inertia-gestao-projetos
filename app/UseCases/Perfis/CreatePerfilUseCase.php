<?php

namespace App\UseCases\Perfis;

use App\DTOs\PerfilData;
use App\Repositories\Eloquent\RoleRepository;
use App\Services\PermissionService;

class CreatePerfilUseCase
{
    public function __construct(private RoleRepository $roleRepository, private PermissionService $permissionService)
    {
        $this->permissionService->createAllPermissions();
    }

    public function execute(PerfilData $perfilData)
    {
        try {
            $role = $this->roleRepository->create($perfilData->name);
            $this->roleRepository->assyncPermissions($role->id, $perfilData->permissions);

            return $role;
        } catch (\Exception $e) {
            dd($e->getMessage());
            throw new \Exception('Erro ao criar o perfil');
        }
    }
}
