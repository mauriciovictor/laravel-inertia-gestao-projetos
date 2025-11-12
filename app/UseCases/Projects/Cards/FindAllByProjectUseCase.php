<?php

namespace App\UseCases\Projects\Cards;

use App\Enums\CardItemPriorityEnum;
use App\Repositories\Eloquent\ProjectCardRepository;
use App\Services\ProjectService;

readonly class FindAllByProjectUseCase
{
    public function __construct(
        private ProjectCardRepository $repository,
        private ProjectService        $projectService
    )
    {
    }

    public function execute(string $projectId): array
    {
        $cards = $this->repository->findAllByProject($projectId);
        $project = $this->projectService->findById($projectId);
        $priorities = CardItemPriorityEnum::mountedPriorities();

        return compact('cards', 'project', 'priorities');
    }
}
