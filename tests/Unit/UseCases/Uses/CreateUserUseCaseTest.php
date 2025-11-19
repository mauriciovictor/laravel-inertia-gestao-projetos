<?php

use App\DTOs\UserData;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;
use App\UseCases\Users\CreateUserUseCase;
use App\ValueObjects\Password;

beforeEach(function () {
    $this->userRepository = Mockery::mock(UserRepository::class);
    $this->roleRepository = Mockery::mock(RoleRepository::class);
    $this->useCase = new CreateUserUseCase($this->userRepository, $this->roleRepository);
});

afterEach(function () {
    Mockery::close();
});

describe('UserUseCases', function () {
    it('Criar um novo usuário', function () {
        $userData = new UserData (
            name: 'John Doe',
            email: 'teste@gmail.com',
            role_id: 1,
            password: new Password('123456')
        );

        $this
            ->userRepository
            ->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function ($param) use ($userData) {
                return $param instanceof UserData &&
                    $param->name === $userData->name &&
                    $param->email === $userData->email &&
                    $param->role_id === $userData->role_id;
            }))
            ->andReturn((object)[
                'id' => 1,
                'name' => 'John Doe',
            ]);

        $this
            ->roleRepository
            ->shouldReceive('assignRoleToUser')
            ->once()
            ->with(1, 1)
            ->andReturn(true);

        $result = $this->useCase->execute($userData);

        expect($result)
            ->toBeObject()
            ->and($result->name)
            ->toBe('John Doe');
    });
});
