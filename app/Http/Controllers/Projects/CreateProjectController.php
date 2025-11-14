<?php

namespace App\Http\Controllers\Projects;

use App\Enums\ProjectStatusEnum;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class CreateProjectController
{
    public function __invoke()
    {
        if (!Gate::allows('project-create')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $status = [];
        foreach (ProjectStatusEnum::cases() as $s) {
            $status[] = [
                'name' => $s->getLabel(),
                'code' => $s->value,
            ];
        }


        return Inertia::render('Projects/Form', compact('status'));
    }
}
