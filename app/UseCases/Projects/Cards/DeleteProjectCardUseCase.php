<?php

namespace App\UseCases\Projects\Cards;

use App\DTOs\ProjectCardData;
use App\Repositories\Eloquent\ProjectCardRepository;

readonly class DeleteProjectCardUseCase
{
    public function __construct(private ProjectCardRepository $repository)
    {

    }

    public function execute(int $project_card_id)
    {
        $this->repository->delete($project_card_id);
    }
}
