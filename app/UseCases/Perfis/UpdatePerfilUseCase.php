<?php

namespace App\UseCases\Perfis;

use App\DTOs\PerfilData;
use App\Repositories\Eloquent\RoleRepository;

class UpdatePerfilUseCase
{
    public function __construct(private RoleRepository $roleRepository)
    {
    }

    public function execute(int $id, PerfilData $perfilData)
    {
        try {
            $this->roleRepository->update($id, $perfilData->name);
            $this->roleRepository->assyncPermissions($id, $perfilData->permissions);
        } catch (\Exception $e) {
            throw new \Exception('Erro ao atualizar o perfil');
        }
    }
}
