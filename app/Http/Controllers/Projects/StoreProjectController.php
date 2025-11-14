<?php

namespace App\Http\Controllers\Projects;

use App\Http\Requests\Projects\CreateProjectRequest;
use App\UseCases\Projects\CreateProjectUseCase;
use Illuminate\Support\Facades\Gate;

class StoreProjectController
{
    public function __construct(private CreateProjectUseCase $createProjectUseCase)
    {
    }

    public function __invoke(CreateProjectRequest $request)
    {
        if (!Gate::allows('project-store')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $data = $request->toDTO();
        $this->createProjectUseCase->execute($data);
        return redirect()->route('projects.index')->with('success', 'Proojeto criado com sucesso');
    }
}
