<?php

use App\DTOs\ProjectData;
use App\Enums\ProjectStatusEnum;
use App\Repositories\Eloquent\ProjectRepository;
use App\UseCases\Projects\UpdateProjectUseCase;

beforeEach(function () {
    $this->projectRepository = Mockery::mock(ProjectRepository::class);
    $this->updateProjectUseCase = new UpdateProjectUseCase($this->projectRepository);
});

afterEach(function () {
    Mockery::close();
});

describe('ProjectUseCases', function () {
    it('atualiza um projeto', function () {
        $projectId = '123';

        $projectData = new ProjectData(
            title: 'Novo Projeto',
            description: 'Projeto atualizado',
            status: ProjectStatusEnum::from('active')
        );

        $this
            ->projectRepository
            ->shouldReceive('update')
            ->once()
            ->with($projectId, $projectData)
            ->andReturn((object)[
                'id' => $projectId,
                'title' => $projectData->title,
                'description' => $projectData->description,
                'status' => $projectData->status->value,
            ]);

        $result = $this->updateProjectUseCase->execute($projectId, $projectData);

        expect($result)
            ->toBeObject()
            ->and($result->description)
            ->toBe('Projeto atualizado');
    });
});
