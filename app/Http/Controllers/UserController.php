<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUseRequest;
use App\Http\Requests\UpdateUseRequest;
use App\Repositories\Eloquent\Models\User;
use App\UseCases\Perfis\GetPerfisToComboBox;
use App\UseCases\Users\CreateUserUseCase;
use App\UseCases\Users\DeleteUserUseCase;
use App\UseCases\Users\GetUsersUseCase;
use App\UseCases\Users\UpdateUserUseCase;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Support\Facades\Gate;

class UserController
{
    public function __construct(
        private CreateUserUseCase   $createUserUseCase,
        private UpdateUserUseCase   $updateUserUseCase,
        private GetUsersUseCase     $getUsersUseCase,
        private DeleteUserUseCase   $deleteUserUseCase,
        private GetPerfisToComboBox $getPerfisToComboBox,
    )
    {
    }

    public function index(Request $request): InertiaResponse
    {
        if (!Gate::allows('user-index')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }

        $users = $this->getUsersUseCase->execute(
            fieldsFilters: ['name', 'email', 'role_name'],
            filterValues: $request->all(),
            fieldSortValues: [
                'order' => $request->input('order'),
                'field' => $request->input('column'),
            ],
            search: $request->input('search') ?? '',
            page: $request->input('page', 1),
            per_page: $request->input('per_page', 5),
            appends: $request->all()
        );
        return Inertia::render('Users/List', compact('users'));
    }

    public function create(Request $request)
    {
        if (!Gate::allows('user-create')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $roles = $this->getPerfisToComboBox->execute();
        return Inertia::render('Users/Form', compact('roles'));
    }

    public function edit(Request $request, int $id)
    {
        if (!Gate::allows('user-edit')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $user = User::find($id);
        $roles = $this->getPerfisToComboBox->execute();
        return Inertia::render('Users/Form', compact('user', 'roles'));
    }

    public function update(UpdateUseRequest $request, int $id)
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

    public function store(CreateUseRequest $request)
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

    public function destroy(int $id)
    {
        if (!Gate::allows('user-delete')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $this->deleteUserUseCase->execute($id);
        return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso');
    }
}
