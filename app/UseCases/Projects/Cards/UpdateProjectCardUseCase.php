<?php

namespace App\UseCases\Projects\Cards;

use App\DTOs\ProjectCardData;
use App\Repositories\Eloquent\ProjectCardRepository;

readonly class UpdateProjectCardUseCase
{
    public function __construct(private ProjectCardRepository $repository)
    {

    }

    public function execute(int $project_card_id, ProjectCardData $data)
    {
        $this->repository->update($project_card_id, $data);
    }
}
