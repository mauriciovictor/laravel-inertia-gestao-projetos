<?php

namespace App\Http\Controllers\Projects;

use App\UseCases\Projects\DeleteProjectUseCase;
use Illuminate\Support\Facades\Gate;

class DeleteProjectController
{
    public function __construct(private DeleteProjectUseCase $deleteProjectUseCase)
    {
    }

    public function __invoke(string $id)
    {
        if (!Gate::allows('project-delete')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $this->deleteProjectUseCase->execute($id);
        return redirect()->route('projects.index')->with('success', 'Projeto deletado com sucesso');
    }
}
