<?php

namespace App\UseCases\Users;

use App\DTOs\UserData;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;

class CreateUserUseCase
{
    public function __construct(private UserRepository $userRepository, private RoleRepository $roleRepository)
    {
    }

    public function execute(UserData $userData)
    {
        try {
            $user = $this->userRepository->create($userData);
            $this->roleRepository->assignRoleToUser($user->id, $userData->role_id);
        } catch (\Exception $e) {
            throw new \Exception('Erro ao criar o usuário');
        }
    }
}
