<?php

namespace App\Http\Controllers\Projects;

use App\UseCases\Projects\ListProjectsUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ListProjectsController
{
    public function __construct(private ListProjectsUseCase $listProjectsUseCase)
    {
    }

    public function __invoke(Request $request)
    {
        if (!Gate::allows('project-index')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }

        $projects = $this->listProjectsUseCase->execute(
            page: $request->input('page', 1),
            per_page: $request->input('per_page', 10),
        );

        return Inertia::render('Projects/ListProjects', compact('projects'));
    }
}
