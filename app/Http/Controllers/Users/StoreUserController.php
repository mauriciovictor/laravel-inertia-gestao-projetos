<?php

namespace App\Http\Controllers\Users;

use App\Http\Requests\Users\CreateUseRequest;
use App\UseCases\Users\CreateUserUseCase;
use Illuminate\Support\Facades\Gate;

class StoreUserController
{
    public function __construct(
        private CreateUserUseCase $createUserUseCase,
    )
    {
    }

    public function __invoke(CreateUseRequest $request)
    {
        if (!Gate::allows('user-store')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        #cria o DTO a partir dos dados validados
        $userData = $request->toDTO();

        #salva o usuário
        $this->createUserUseCase->execute($userData);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso');
    }
}
