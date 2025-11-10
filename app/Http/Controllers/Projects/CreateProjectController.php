<?php

namespace App\Http\Controllers\Projects;

use App\Enums\ProjectStatusEnum;
use Inertia\Inertia;

class CreateProjectController
{
    public function __invoke()
    {
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
