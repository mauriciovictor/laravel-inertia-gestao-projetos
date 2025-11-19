<?php

use App\DTOs\PerfilData;
use App\Repositories\Eloquent\RoleRepository;
use App\Services\PermissionService;
use App\UseCases\Perfis\CreatePerfilUseCase;

beforeEach(function () {
    $this->roleRepository = Mockery::mock(RoleRepository::class);
    $this->permissionService = Mockery::mock(PermissionService::class);


    $this
        ->permissionService
        ->shouldReceive('createAllPermissions')
        ->once()
        ->withNoArgs()
        ->andReturn(true);

    $this->useCase = new CreatePerfilUseCase($this->roleRepository, $this->permissionService);


});

afterEach(function () {
    Mockery::close();
});

describe('PerfilUseCases', function () {
    it('cria um novo perfil', function () {
        $perfilData = new PerfilData(
            name: 'Administrador',
            permissions: ['create_user', 'edit_user', 'delete_user']
        );

        $perfilId = 1;

        $this->roleRepository
            ->shouldReceive('create')
            ->once()
            ->with($perfilData->name)
            ->andReturn((object)[
                'id' => $perfilId,
                'name' => $perfilData->name,
                'permissions' => $perfilData->permissions,
            ]);

        $this
            ->roleRepository
            ->shouldReceive('assyncPermissions')
            ->once()
            ->with($perfilId, $perfilData->permissions)
            ->andReturn(true);

        $result = $this->useCase->execute($perfilData);

        expect($result)
            ->tobeObject()
            ->and($result->id)
            ->toBe($perfilId);
    });
});
