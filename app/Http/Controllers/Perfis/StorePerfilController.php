<?php

namespace App\Http\Controllers\Perfis;

use App\Http\Requests\Perfis\CreatePerfilRequest;
use App\UseCases\Perfis\CreatePerfilUseCase;
use Illuminate\Support\Facades\Gate;

class StorePerfilController
{
    public function __construct(
        private CreatePerfilUseCase $createPerfilUseCase,
    )
    {
    }

    public function __invoke(CreatePerfilRequest $request)
    {
        if (!Gate::allows('perfil-store')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $perfilData = $request->toDTO();
        $this->createPerfilUseCase->execute($perfilData);
        return redirect()->route('roles.index')->with('success', 'Perfil criado com sucesso');
    }
}

