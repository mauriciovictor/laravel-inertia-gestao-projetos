<?php

namespace App\Http\Controllers\Projects;

use App\Http\Requests\Projects\UpdateProjectRequest;
use App\UseCases\Projects\UpdateProjectUseCase;
use Illuminate\Support\Facades\Gate;

class UpdateProjectController
{
    public function __construct(private UpdateProjectUseCase $updateProjectUseCase)
    {
    }

    public function __invoke(UpdateProjectRequest $request, string $id)
    {
        if (!Gate::allows('project-update')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        
        $this->updateProjectUseCase->execute($id, $request->toDTO());
        return redirect()->route('projects.index')->with('success', 'Projeto atualizado com sucesso');
    }
}
