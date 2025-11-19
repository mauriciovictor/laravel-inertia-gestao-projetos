<?php

use App\Repositories\Eloquent\ProjectRepository;
use App\UseCases\Projects\FindProjectUseCase;

beforeEach(function () {
    $this->projectRepository = Mockery::mock(ProjectRepository::class);
    $this->findProjectUseCase = new FindProjectUseCase($this->projectRepository);
});

afterEach(function () {
    Mockery::close();
});

describe('ProjectUseCases', function () {
    it('encontra um projeto pelo ID', function () {
        $projectId = '123';

        $this->projectRepository
            ->shouldReceive('findById')
            ->once()
            ->with($projectId)
            ->andReturn((object)['id' => $projectId]);

        $result = $this->findProjectUseCase->execute($projectId);

        expect($result)->toBeObject()->and($result->id)->toBe($projectId);
    });
});
