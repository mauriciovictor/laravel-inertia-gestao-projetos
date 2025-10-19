<?php

namespace App\UseCases\Users;

use App\DTOs\UserData;
use App\Repositories\Eloquent\UserRepository;

class UpdateUserUseCase
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function execute(int $id, UserData $userData)
    {
        try {
            $this->userRepository->update($id, $userData);
        } catch (\Exception $e) {
            throw new \Exception('Erro ao atualizar o usuário');
        }
    }
}
