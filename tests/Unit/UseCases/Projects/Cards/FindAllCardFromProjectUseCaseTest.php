<?php

use App\Repositories\Eloquent\ProjectCardRepository;
use App\Services\ProjectService;
use App\UseCases\Projects\Cards\FindAllByProjectUseCase;

beforeEach(function () {
    $this->projectId = '123e4567-e89b-12d3-a456-426614174000';

    $this->projectService = Mockery::mock(ProjectService::class);
    $this->projectCardRepository = Mockery::mock(ProjectCardRepository::class);

    $this
        ->projectService
        ->shouldReceive('findById')
        ->once()
        ->with($this->projectId)
        ->andReturn((object)[
            'id' => $this->projectId,
            'title' => 'Novo Projeto',
        ]);

    $this->useCase = new FindAllByProjectUseCase($this->projectCardRepository, $this->projectService);
});

afterEach(function () {
    Mockery::close();
});

describe('ProjectCardUseCases', function () {
    it('Busca todos os cards de um projeto', function () {
        $cardId = 1;

        $this->projectCardRepository
            ->shouldReceive('findAllByProject')
            ->once()
            ->with($this->projectId)
            ->andReturn(collect([
                [
                    'id' => 1,
                    'title' => 'Novo Card',
                ],
                [
                    'id' => 2,
                    'title' => 'Novo Card',
                ]
            ]));

        $result = $this->useCase->execute($this->projectId);

        expect($result)
            ->toHaveKeys(['cards', 'project', 'priorities'])
            ->and($result['cards'])
            ->toHaveCount(2);
    });
});
