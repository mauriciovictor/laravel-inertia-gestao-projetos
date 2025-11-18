<?php


use App\Repositories\Eloquent\RoleRepository;
use App\UseCases\Perfis\GetPerfisUseCase;

beforeEach(function () {
    $this->roleRepository = Mockery::mock(RoleRepository::class);
    $this->useCase = new GetPerfisUseCase($this->roleRepository);
});

afterEach(function () {
    Mockery::close();
});

describe('PerfilUseCases', function () {
    it('lista todos os perfis', function () {
        $page = 1;
        $perPage = 10;
        $fieldsFilters = ['role_id'];
        $filterValues = ['role_id' => 1];
        $fieldSortValues = ['name' => 'asc'];
        $appends = ['profile'];
        $search = 'john';

        $this->roleRepository
            ->shouldReceive('allPaged')
            ->once()
            ->with(
                $fieldsFilters,
                $filterValues,
                $fieldSortValues,
                $search,
                $page,
                $perPage,
                $appends,
            )
            ->andReturn(Mockery::mock(\Illuminate\Pagination\AbstractPaginator::class));


        $result = $this->useCase->execute($fieldsFilters,
            $filterValues,
            $fieldSortValues,
            $search,
            $page,
            $perPage,
            $appends,
        );

        expect($result)->toBeInstanceOf(\Illuminate\Pagination\AbstractPaginator::class);
    });
});
