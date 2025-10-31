<?php

namespace App\Http\Controllers\Users;

use App\Repositories\Eloquent\Models\User;
use App\UseCases\Perfis\GetPerfisToComboBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class EditUserController
{
    public function __construct(
        private GetPerfisToComboBox $getPerfisToComboBox
    )
    {
    }

    public function __invoke(Request $request, int $id)
    {
        if (!Gate::allows('user-edit')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $user = User::find($id);
        $roles = $this->getPerfisToComboBox->execute();
        return Inertia::render('Users/Form', compact('user', 'roles'));
    }
}
