<?php

namespace App\Http\Controllers\Projects;

use App\Http\Requests\Projects\UpdateProjectRequest;
use App\UseCases\Projects\UpdateProjectUseCase;

class UpdateProjectController
{
    public function __construct(private UpdateProjectUseCase $updateProjectUseCase)
    {
    }

    public function __invoke(UpdateProjectRequest $request, string $id)
    {
        $this->updateProjectUseCase->execute($id, $request->toDTO());
        return redirect()->route('projects.index')->with('success', 'Projeto atualizado com sucesso');
    }
}
