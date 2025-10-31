<?php

namespace App\Http\Controllers\Perfis;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class CreatePerfilController
{
    public function __invoke(Request $request)
    {
        if (!Gate::allows('perfil-create')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }

        $features = PermissionService::getFeatures();
        return Inertia::render('Perfis/Form', ['features' => $features]);;
    }
}
