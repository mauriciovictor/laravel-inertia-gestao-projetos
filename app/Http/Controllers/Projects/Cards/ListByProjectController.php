<?php

namespace App\Http\Controllers\Projects\Cards;

use App\UseCases\Projects\Cards\FindAllByProjectUseCase;
use Inertia\Inertia;

readonly class ListByProjectController
{
    public function __construct(
        private FindAllByProjectUseCase $useCase
    )
    {
    }

    public function __invoke(string $projectId)
    {
        $data = $this->useCase->execute($projectId);

        return Inertia::render('Projects/Cards/ListCards', $data);
    }
}
