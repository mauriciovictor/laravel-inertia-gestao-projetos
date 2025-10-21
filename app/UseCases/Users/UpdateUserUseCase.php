<?php

namespace App\UseCases\Users;

use App\DTOs\UserData;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;

class UpdateUserUseCase
{
    public function __construct(private UserRepository $userRepository, private RoleRepository $roleRepository)
    {
    }

    public function execute(int $id, UserData $userData)
    {
        try {
            $user = $this->userRepository->update($id, $userData);
            $this->roleRepository->removeRoleFromUser($user->id, $user->role_id);
            $this->roleRepository->assignRoleToUser($user->id, $userData->role_id);
        } catch (\Exception $e) {
            throw new \Exception('Erro ao atualizar o usuário');
        }
    }
}
