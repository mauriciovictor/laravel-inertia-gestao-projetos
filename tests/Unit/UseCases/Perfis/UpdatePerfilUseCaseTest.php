<?php

use App\DTOs\PerfilData;
use App\Repositories\Eloquent\RoleRepository;
use App\Services\PermissionService;
use App\UseCases\Perfis\UpdatePerfilUseCase;

beforeEach(function () {
    $this->roleRepository = Mockery::mock(RoleRepository::class);
    $this->permissionsService = Mockery::mock(PermissionService::class);

    $this
        ->permissionsService
        ->shouldReceive('createAllPermissions')
        ->once()
        ->withNoArgs()
        ->andReturn(true);

    $this->useCase = new UpdatePerfilUseCase($this->roleRepository, $this->permissionsService);
});

afterEach(function () {
    Mockery::close();
});

describe('PerfilUseCases', function () {
    it('atualiza um perfil', function () {
        $perfilId = 123;

        $perfilData = new PerfilData(
            name: 'Novo Projeto',
            permissions: ['admin'],
            id: 123
        );

        $this
            ->roleRepository
            ->shouldReceive('assyncPermissions')
            ->once()
            ->with($perfilId, $perfilData->permissions)
            ->andReturn(true);

        $this
            ->roleRepository
            ->shouldReceive('update')
            ->once()
            ->with($perfilId, $perfilData->name)
            ->andReturn((object)[
                'id' => $perfilId,
                'name' => $perfilData->name,
                'permissions' => $perfilData->permissions,
            ]);

        $result = $this->useCase->execute($perfilId, $perfilData);
        
        expect($result)
            ->toBeObject()
            ->and($result->name)
            ->toBe($perfilData->name);
    });
});
