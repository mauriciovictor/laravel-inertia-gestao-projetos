<?php

use App\Repositories\Eloquent\ProjectRepository;
use App\UseCases\Projects\DeleteProjectUseCase;

beforeEach(function () {
    $this->projectRepository = Mockery::mock(ProjectRepository::class);
    $this->deleteProjectUseCase = new DeleteProjectUseCase($this->projectRepository);
});

afterEach(function () {
    Mockery::close();
});

describe('ProjectUseCases', function () {
    it('deleta um projeto', function () {
        $projectId = '123';

        $this
            ->projectRepository
            ->shouldReceive('delete')
            ->once()
            ->with($projectId)
            ->andReturn(true);

        $result = $this->deleteProjectUseCase->execute($projectId);

        expect($result)->toBeTrue();
    });
});
