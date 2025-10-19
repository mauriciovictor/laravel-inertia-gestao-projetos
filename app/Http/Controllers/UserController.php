<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUseRequest;
use App\Http\Requests\UpdateUseRequest;
use App\Repositories\Eloquent\Models\User;
use App\UseCases\Users\CreateUserUseCase;
use App\UseCases\Users\UpdateUserUseCase;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class UserController
{
    public function __construct(
        private CreateUserUseCase $createUserUseCase,
        private UpdateUserUseCase $updateUserUseCase)
    {
    }

    public function index(Request $request): InertiaResponse
    {
        $users = User::all();
        return Inertia::render('Users/List', compact('users'));
    }

    public function create(Request $request)
    {
        return Inertia::render('Users/Form');
    }

    public function edit(Request $request, int $id)
    {
        $user = User::find($id);
        return Inertia::render('Users/Form', compact('user'));
    }

    public function update(UpdateUseRequest $request, int $id)
    {
        #cria o DTO a partir dos dados validados
        $userData = $request->toDTO();

        #atualiza o usuário
        $this->updateUserUseCase->execute($id, $userData);

        return redirect()->route('users.index')->with('success', 'Usuário alterado com sucesso');
    }


    public function store(CreateUseRequest $request)
    {
        #cria o DTO a partir dos dados validados
        $userData = $request->toDTO();

        #salva o usuário
        $this->createUserUseCase->execute($userData);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso');
    }
}
