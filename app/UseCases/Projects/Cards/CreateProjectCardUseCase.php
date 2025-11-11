<?php

namespace App\UseCases\Projects\Cards;

use App\DTOs\ProjectCardData;
use App\Repositories\Eloquent\ProjectCardRepository;

readonly class CreateProjectCardUseCase
{
    public function __construct(private ProjectCardRepository $repository)
    {

    }

    public function execute(ProjectCardData $data)
    {
        $this->repository->create($data);
    }
}
