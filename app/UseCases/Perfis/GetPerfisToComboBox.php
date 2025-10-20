<?php

namespace App\UseCases\Perfis;

use App\Repositories\Eloquent\RoleRepository;

class GetPerfisToComboBox
{
    public function __construct(
        private RoleRepository $roleRepository,
    )
    {
    }

    public function execute(): array
    {
        $roles = $this->roleRepository->all();
        $comboBoxItems = [];

        foreach ($roles as $role) {
            $comboBoxItems[] = [
                'name' => $role->name,
                'code' => $role->id,
            ];
        }

        return $comboBoxItems;
    }
}
