<?php

namespace App\Http\Controllers\Projects;

use App\Http\Requests\Projects\CreateProjectRequest;
use App\UseCases\Projects\CreateProjectUseCase;

class StoreProjectController
{
    public function __construct(private CreateProjectUseCase $createProjectUseCase)
    {
    }

    public function __invoke(CreateProjectRequest $request)
    {
        $data = $request->toDTO();
        $this->createProjectUseCase->execute($data);
        return redirect()->route('projects.index')->with('success', 'Proojeto criado com sucesso');
    }
}
