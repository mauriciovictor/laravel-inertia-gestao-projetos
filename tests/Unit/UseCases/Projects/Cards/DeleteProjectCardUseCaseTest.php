<?php

use App\DTOs\ProjectCardData;
use App\Repositories\Eloquent\ProjectCardRepository;
use App\UseCases\Projects\Cards\DeleteProjectCardUseCase;

beforeEach(function () {
    $this->projectCardRepository = Mockery::mock(ProjectCardRepository::class);
    $this->useCase = new DeleteProjectCardUseCase($this->projectCardRepository);
});

afterEach(function () {
    Mockery::close();
});

describe('ProjectCardUseCases', function () {
    it('delete um card de um projeto', function () {
        $projectId = '123e4567-e89b-12d3-a456-426614174000';
        $cardId = 1;

        $projectData = new ProjectCardData(
            project_id: $projectId,
            title: 'Novo Card',
            color: '#fff',
            description: 'Novo card',
        );


        $this->projectCardRepository
            ->shouldReceive('delete')
            ->once()
            ->with($cardId)
            ->andReturn(true);

        $result = $this->useCase->execute($cardId);

        expect($result)->toBeTrue();
    });
});
