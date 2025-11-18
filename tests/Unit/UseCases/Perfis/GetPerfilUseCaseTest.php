<?php

use App\Repositories\Eloquent\RoleRepository;
use App\UseCases\Perfis\GetPerfilUseCase;

beforeEach(function () {
    $this->roleRepository = Mockery::mock(RoleRepository::class);
    $this->useCase = new GetPerfilUseCase($this->roleRepository);
});

afterEach(function () {
    Mockery::close();
});

describe('PerfiltUseCases', function () {
    it('encontra um perfil pelo ID', function () {
        $perfilId = 1;

        $permissionsNames = ['create_user', 'edit_user', 'delete_user'];

        $permissionsMock = Mockery::mock();

        #mock o a funcionalidade de pluck e toArray da relação permissions
        $permissionsMock
            ->shouldReceive('pluck')
            ->once()
            ->with('name')
            ->andReturnSelf();

        $permissionsMock
            ->shouldReceive('toArray')
            ->once()
            ->andReturn($permissionsNames);

        $mockRole = Mockery::mock();
        $mockRole->id = $perfilId;
        $mockRole->name = 'Administrador';

        $mockRole
            ->shouldReceive('permissions')
            ->once()
            ->andReturn($permissionsMock);

        $this->roleRepository
            ->shouldReceive('findById')
            ->once()
            ->with($perfilId)
            ->andReturn($mockRole);

        $result = $this->useCase->execute($perfilId);

        expect($result)->toBeObject()->and($result->id)->toBe($perfilId);
    });
});
