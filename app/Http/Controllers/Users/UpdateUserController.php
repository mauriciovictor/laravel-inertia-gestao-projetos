<?php

namespace App\Http\Controllers\Users;

use App\Http\Requests\Users\UpdateUseRequest;
use App\UseCases\Users\UpdateUserUseCase;
use Illuminate\Support\Facades\Gate;

class UpdateUserController
{
    public function __construct(
        private UpdateUserUseCase $updateUserUseCase,
    )
    {
    }

    public function __invoke(UpdateUseRequest $request, int $id)
    {
        if (!Gate::allows('user-update')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        #cria o DTO a partir dos dados validados
        $userData = $request->toDTO();

        #atualiza o usuário
        $this->updateUserUseCase->execute($id, $userData);

        return redirect()->route('users.index')->with('success', 'Usuário alterado com sucesso');
    }
}
