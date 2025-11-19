<?php

use App\Repositories\Eloquent\RoleRepository;
use App\UseCases\Perfis\GetPerfisToComboBox;

beforeEach(function () {
    $this->roleRepository = Mockery::mock(RoleRepository::class);
    $this->useCase = new GetPerfisToComboBox($this->roleRepository);
});

afterEach(function () {
    Mockery::close();
});

describe('PerfiltUseCases', function () {
    it('Retorna uma lista de perfis formatado para serem usados em combo box', function () {

        #dados vindo do model
        $roles = collect([
            (object)['id' => 1, 'name' => 'Administrador'],
            (object)['id' => 2, 'name' => 'Normal User']
        ]);

        #dados esperados
        $expected = [
            ['name' => 'Administrador', 'code' => 1],
            ['name' => 'Normal User', 'code' => 2]
        ];

        $this
            ->roleRepository
            ->shouldReceive('all')
            ->once()
            ->withNoArgs()
            ->andReturn($roles);

        $result = $this->useCase->execute();

        expect($result)->toBe($expected);
    });
});
