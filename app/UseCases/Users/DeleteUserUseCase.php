<?php

namespace App\UseCases\Users;

use App\Repositories\Eloquent\UserRepository;

class DeleteUserUseCase
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function execute(int $user_id)
    {
        return $this->userRepository->delete($user_id);
    }
}
