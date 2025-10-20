<?php

namespace App\UseCases\Perfis;

use App\DTOs\PerfilData;
use App\Repositories\Eloquent\RoleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetPerfilUseCase
{
    public function __construct(private RoleRepository $roleRepository)
    {
    }

    public function execute(int $role_id): PerfilData
    {
        $perfil = $this->roleRepository->findById($role_id);

        $perfilData = new PerfilData(
            name: $perfil->name,
            permissions: $perfil->permissions()->pluck('name')->toArray(),
            id: $perfil->id,
        );

        return $perfilData;
    }
}
