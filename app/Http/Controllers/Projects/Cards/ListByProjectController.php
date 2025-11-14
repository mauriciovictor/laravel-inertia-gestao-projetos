<?php

namespace App\Http\Controllers\Projects\Cards;

use App\UseCases\Projects\Cards\FindAllByProjectUseCase;
use Illuminate\Support\Facades\Gate;
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
        if (!Gate::allows('project-card-index')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $data = $this->useCase->execute($projectId);

        return Inertia::render('Projects/Cards/ListCards', $data);
    }
}
