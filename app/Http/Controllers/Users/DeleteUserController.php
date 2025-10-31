<?php

namespace App\Http\Controllers\Users;

use App\UseCases\Users\DeleteUserUseCase;
use Illuminate\Support\Facades\Gate;

class DeleteUserController
{
    public function __construct(
        private DeleteUserUseCase $deleteUserUseCase,
    )
    {
    }

    public function __invoke(int $id)
    {
        if (!Gate::allows('user-delete')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $this->deleteUserUseCase->execute($id);
        return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso');
    }
}
