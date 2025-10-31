<?php

namespace App\Http\Controllers\Perfis;

use App\UseCases\Perfis\DeletePerfilUseCase;
use Illuminate\Support\Facades\Gate;

class DeletePerfilController
{
    public function __construct(
        private DeletePerfilUseCase $deletePerfilUseCase,
    )
    {
    }

    public function __invoke(int $id)
    {
        if (!Gate::allows('perfil-delete')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $this->deletePerfilUseCase->execute($id);
        return redirect()->route('roles.index')->with('success', 'Perfil deletado com sucesso');
    }
}
