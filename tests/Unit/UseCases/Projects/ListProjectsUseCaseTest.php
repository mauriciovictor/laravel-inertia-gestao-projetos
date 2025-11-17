<?php

use App\Repositories\Eloquent\ProjectRepository;
use App\UseCases\Projects\ListProjectsUseCase;

beforeEach(function () {
    $this->projectRepository = Mockery::mock(ProjectRepository::class);
    $this->listProjectsUseCase = new ListProjectsUseCase($this->projectRepository);
});

afterEach(function () {
    Mockery::close();
});

describe('ProjectUseCases', function () {
    it('lista todos os projetos', function () {
        $page = 1;
        $perPage = 10;

        $this->projectRepository
            ->shouldReceive('allPaged')
            ->once()
            ->with($page, $perPage)
            ->andReturn(Mockery::mock(\Illuminate\Pagination\AbstractPaginator::class));

        $result = $this->listProjectsUseCase->execute($page, $perPage);

        expect($result)->toBeInstanceOf(\Illuminate\Pagination\AbstractPaginator::class);
    });
});
