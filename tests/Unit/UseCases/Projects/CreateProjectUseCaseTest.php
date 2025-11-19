<?php

use App\DTOs\ProjectData;
use App\Enums\ProjectStatusEnum;
use App\Repositories\Eloquent\ProjectRepository;
use App\UseCases\Projects\CreateProjectUseCase;

beforeEach(function () {
    $this->projectRepository = Mockery::mock(ProjectRepository::class);
    $this->useCase = new CreateProjectUseCase($this->projectRepository);
});

afterEach(function () {
    Mockery::close();
});

describe('ProjectUseCases', function () {
    it('cria um projeto', function () {
        $projectData = new ProjectData(
            title: 'Novo Projeto',
            description: 'Descricao do projeto',
            status: ProjectStatusEnum::from('active')
        );

        $projectId = '123e4567-e89b-12d3-a456-426614174000';

        $this->projectRepository
            ->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function ($param) use ($projectData) {
                return $param instanceof ProjectData &&
                    $param->title === $projectData->title &&
                    $param->description === $projectData->description &&
                    $param->status === $projectData->status;
            }))
            ->andReturn((object)[
                'id' => $projectId,
                'title' => $projectData->title,
                'description' => $projectData->description,
                'status' => $projectData->status->value,
            ]);

        $result = $this->useCase->execute($projectData);

        expect($result)
            ->tobeObject()
            ->and($result->id)
            ->toBe($projectId);
    });
});
