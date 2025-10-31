<?php

namespace App\Http\Controllers\Perfis;

use App\Http\Requests\Perfis\UpdatePerfilRequest;
use App\UseCases\Perfis\UpdatePerfilUseCase;
use Illuminate\Support\Facades\Gate;

class UpdatePerfilController
{
    public function __construct(
        private UpdatePerfilUseCase $updatePerfilUseCase,
    )
    {
    }

    public function __invoke(UpdatePerfilRequest $request, int $id)
    {
        if (!Gate::allows('perfil-update')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }

        #cria o DTO a partir dos dados validados
        $perfilData = $request->toDTO();

        #atualiza o usuário
        $this->updatePerfilUseCase->execute($id, $perfilData);

        return redirect()->route('roles.index')->with('success', 'Perfil atualizado com sucesso');
    }
}
