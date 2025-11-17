<?php

use App\DTOs\UserData;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;
use App\UseCases\Users\UpdateUserUseCase;

beforeEach(function () {
    $this->userRepository = Mockery::mock(UserRepository::class)->makePartial();
    $this->roleRepository = Mockery::mock(RoleRepository::class)->makePartial();
    $this->useCase = new UpdateUserUseCase($this->userRepository, $this->roleRepository);
});

afterEach(function () {
    Mockery::close();
});

describe('UserUseCases', function () {
    it('atualizar usuário', function () {
        $userId = 1;
      
        $userData = new UserData(
            name: 'John Doe',
            email: 'teste@gmail.com',
            role_id: 1,
            password: null
        );

        $this->userRepository
            ->shouldReceive('update')
            ->once()
            ->with($userId, $userData)
            ->andReturn((object)[
                'id' => $userId,
                'name' => $userData->name,
                'email' => $userData->email,
                'role_id' => $userData->role_id,
            ]);

        // Remove a role antiga
        $this->roleRepository
            ->shouldReceive('removeRoleFromUser')
            ->once()
            ->with($userId, $userData->role_id)
            ->andReturn(true);

        // Atribui a nova role
        $this->roleRepository
            ->shouldReceive('assignRoleToUser')
            ->once()
            ->with($userId, $userData->role_id)
            ->andReturn(true);

        // Atualiza o usuário
        $result = $this->useCase->execute($userId, $userData);

        expect($result)->toBeObject()->and($result->name)->toBe('John Doe');
    });
});
