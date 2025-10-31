<?php

namespace App\Http\Controllers\Perfis;

use App\Services\PermissionService;
use App\UseCases\Perfis\GetPerfilUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class EditPerfilController
{
    public function __construct(
        private GetPerfilUseCase $getPerfilUseCase,
    )
    {
    }

    public function __invoke(Request $request, int $id)
    {
        if (!Gate::allows('perfil-edit')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }

        $features = PermissionService::getFeatures();
        $perfil = $this->getPerfilUseCase->execute($id);

        return Inertia::render('Perfis/Form', ['features' => $features, 'perfil' => $perfil]);
    }
}
