<?php

namespace App\Http\Controllers\Projects;

use App\UseCases\Projects\ListProjectsUseCase;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ListProjectsController
{
    public function __construct(private ListProjectsUseCase $listProjectsUseCase)
    {
    }

    public function __invoke(Request $request)
    {
        $projects = $this->listProjectsUseCase->execute(
            page: $request->input('page', 1),
            per_page: $request->input('per_page', 10),
        );

        return Inertia::render('Projects/ListProjects', compact('projects'));
    }
}
