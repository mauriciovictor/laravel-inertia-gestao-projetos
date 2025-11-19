<?php

use App\DTOs\PerfilData;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Services\PermissionService;
use App\UseCases\Perfis\DeletePerfilUseCase;

beforeEach(function () {
    $this->roleRepository = Mockery::mock(RoleRepository::class);
    $this->permissionService = Mockery::mock(PermissionService::class);
    $this->userRepository = Mockery::mock(UserRepository::class);

    $this
        ->permissionService
        ->shouldReceive('createAllPermissions')
        ->once()
        ->withNoArgs()
        ->andReturn(true);

    $this->useCase = new DeletePerfilUseCase(
        $this->roleRepository,
        $this->permissionService,
        $this->userRepository
    );
});

afterEach(function () {
    Mockery::close();
});

describe('PerfilUseCases', function () {
    it('Deleta um perfil de usuário', function () {
        $perfilID = 1;

        $this->userRepository
            ->shouldReceive('findCountByRole')
            ->once()
            ->with($perfilID)
            ->andReturn(0);

        $this->roleRepository
            ->shouldReceive('delete')
            ->once()
            ->with($perfilID)
            ->andReturn(true);

        $result = $this->useCase->execute($perfilID);

        expect($result)->toBeTrue();
    });

    it('Não é possível deletar perfil com usuários vinculados', function () {
        $perfilID = 1;

        $this->userRepository
            ->shouldReceive('findCountByRole')
            ->once()
            ->with($perfilID)
            ->andReturn(1);

        $this->roleRepository
            ->shouldReceive('delete')
            ->never();

        expect(fn() => $this->useCase->execute($perfilID))
            ->toThrow(Exception::class, 'Existem usuários vinculados a este perfil.');
    });
});
