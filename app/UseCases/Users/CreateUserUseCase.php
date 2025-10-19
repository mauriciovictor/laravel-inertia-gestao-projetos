<?php

namespace App\UseCases\Users;

use App\DTOs\UserData;
use App\Repositories\Eloquent\UserRepository;

class CreateUserUseCase
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function execute(UserData $userData)
    {
        try {
            $this->userRepository->create($userData);
        } catch (\Exception $e) {
            throw new \Exception('Erro ao criar o usuário');
        }
    }
}
