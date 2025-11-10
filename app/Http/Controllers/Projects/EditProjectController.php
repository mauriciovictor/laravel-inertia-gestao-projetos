<?php

namespace App\Http\Controllers\Projects;

use App\Enums\ProjectStatusEnum;
use App\UseCases\Projects\FindProjectUseCase;
use Inertia\Inertia;

class EditProjectController
{
    public function __construct(private FindProjectUseCase $findProjectUseCase)
    {
    }

    public function __invoke(string $id)
    {
        $status = [];

        foreach (ProjectStatusEnum::cases() as $s) {
            $status[] = [
                'name' => $s->getLabel(),
                'code' => $s->value,
            ];
        }

        $project = $this->findProjectUseCase->execute($id);

        return Inertia::render('Projects/Form', compact('project', 'status'));
    }
}
