<?php

namespace App\Http\Controllers\Users;

use App\UseCases\Perfis\GetPerfisToComboBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class CreateUserController
{
    public function __construct(
        private GetPerfisToComboBox $getPerfisToComboBox,
    )
    {
    }

    public function __invoke(Request $request)
    {
        if (!Gate::allows('user-create')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $roles = $this->getPerfisToComboBox->execute();
        return Inertia::render('Users/Form', compact('roles'));
    }
}
