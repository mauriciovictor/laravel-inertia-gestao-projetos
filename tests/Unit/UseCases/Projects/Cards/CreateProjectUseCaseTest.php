<?php

use App\DTOs\ProjectCardData;
use App\Repositories\Eloquent\ProjectCardRepository;
use App\UseCases\Projects\Cards\CreateProjectCardUseCase;

beforeEach(function () {
    $this->projectCardRepository = Mockery::mock(ProjectCardRepository::class);
    $this->useCase = new CreateProjectCardUseCase($this->projectCardRepository);
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
            ->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function ($param) use ($projectData) {
                return $param instanceof ProjectCardData &&
                    $param->title === $projectData->title &&
                    $param->description === $projectData->description &&
                    $param->color === $projectData->color &&
                    $param->project_id === $projectData->project_id;
            }))
            ->andReturn((object)[
                'id' => $cardId,
                'project_id' => $projectId,
                'title' => $projectData->title,
                'color' => $projectData->color,
                'description' => $projectData->description,
            ]);

        $result = $this->useCase->execute($projectData);

        expect($result)
            ->tobeObject()
            ->and($result->id)
            ->toBe($cardId);
    });
});
