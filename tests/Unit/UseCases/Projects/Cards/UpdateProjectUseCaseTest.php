<?php

use App\DTOs\ProjectCardData;
use App\Repositories\Eloquent\ProjectCardRepository;
use App\UseCases\Projects\Cards\UpdateProjectCardUseCase;

beforeEach(function () {
    $this->projectCardRepository = Mockery::mock(ProjectCardRepository::class);
    $this->useCase = new UpdateProjectCardUseCase($this->projectCardRepository);
});

afterEach(function () {
    Mockery::close();
});

describe('ProjectCardUseCases', function () {
    it('cria um novo card em um projeto', function () {
        $projectId = '123e4567-e89b-12d3-a456-426614174000';
        $cardId = 1;

        $projectData = new ProjectCardData(
            project_id: $projectId,
            title: 'Novo Card',
            color: '#fff',
            description: 'Novo card',
        );


        $this->projectCardRepository
            ->shouldReceive('update')
            ->once()
            ->with($cardId, $projectData)
            ->andReturn((object)[
                'id' => $cardId,
                'project_id' => $projectId,
                'title' => $projectData->title,
                'color' => $projectData->color,
                'description' => $projectData->description,
            ]);

        $result = $this->useCase->execute($cardId, $projectData);

        expect($result)
            ->tobeObject()
            ->and($result->id)
            ->toBe($cardId);
    });
});
