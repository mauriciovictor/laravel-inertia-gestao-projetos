<?php

use App\Repositories\Eloquent\UserRepository;
use App\UseCases\Users\GetUsersUseCase;
use Illuminate\Pagination\AbstractPaginator;

beforeEach(function () {
    $this->userRepository = Mockery::mock(UserRepository::class)->makePartial();
    $this->useCase = new GetUsersUseCase($this->userRepository);
});

afterEach(function () {
    Mockery::close();
});
it('retorna usuários paginados chamando o repositório corretamente', function () {

    // Dados usados na chamada
    $fieldsFilters = ['role_id'];
    $filterValues = ['role_id' => 1];
    $fieldSortValues = ['name' => 'asc'];
    $appends = ['profile'];
    $search = 'john';
    $page = 2;
    $perPage = 10;


    // Espera que o repositório seja chamado corretamente
    $this->userRepository
        ->shouldReceive('allPaged')
        ->once()
        ->with(
            $fieldsFilters,
            $filterValues,
            $fieldSortValues,
            $appends,
            $search,
            $page,
            $perPage
        )
        ->andReturn(Mockery::mock(AbstractPaginator::class));

    // Executa o caso de uso
    $result = $this->useCase->execute(
        $fieldsFilters,
        $filterValues,
        $fieldSortValues,
        $appends,
        $search,
        $page,
        $perPage
    );

    // Verifica retorno
    expect($result)->toBeInstanceOf(AbstractPaginator::class);
});
