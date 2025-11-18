<?php

namespace App\UseCases\Perfis;

use App\DTOs\PerfilData;
use App\Repositories\Eloquent\RoleRepository;
use App\Services\PermissionService;

class UpdatePerfilUseCase
{
    public function __construct(private RoleRepository $roleRepository, private PermissionService $permissionService)
    {
        $this->permissionService->createAllPermissions();
    }

    public function execute(int $id, PerfilData $perfilData)
    {
        try {
            $role = $this->roleRepository->update($id, $perfilData->name);
            $this->roleRepository->assyncPermissions($id, $perfilData->permissions);

            return $role;
        } catch (\Exception $e) {
            dd($e);
            throw new \Exception('Erro ao atualizar o perfil');
        }
    }
}
