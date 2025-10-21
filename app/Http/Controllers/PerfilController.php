<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePerfilRequest;
use App\Http\Requests\UpdatePerfilRequest;
use App\Services\PermissionService;
use App\UseCases\Perfis\CreatePerfilUseCase;
use App\UseCases\Perfis\DeletePerfilUseCase;
use App\UseCases\Perfis\GetPerfilUseCase;
use App\UseCases\Perfis\GetPerfisToComboBox;
use App\UseCases\Perfis\GetPerfisUseCase;
use App\UseCases\Perfis\UpdatePerfilUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class PerfilController
{
    public function __construct(
        private GetPerfisUseCase    $getPerfisUseCase,
        private CreatePerfilUseCase $createPerfilUseCase,
        private GetPerfilUseCase    $getPerfilUseCase,
        private UpdatePerfilUseCase $updatePerfilUseCase,
        private DeletePerfilUseCase $deletePerfilUseCase,
        private GetPerfisToComboBox $getPerfisToComboBox,
    )
    {
    }

    public function index(Request $request): InertiaResponse
    {
        if (!Gate::allows('perfil-index')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }

        $perfis = $this->getPerfisUseCase->execute(fieldsFilters: ['name', 'email'],
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
        return Inertia::render('Perfis/List', compact('perfis'));
    }

    public function edit(Request $request, int $id)
    {
        if (!Gate::allows('perfil-edit')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $features = PermissionService::getFeatures();
        $perfil = $this->getPerfilUseCase->execute($id);
        return Inertia::render('Perfis/Form', ['features' => $features, 'perfil' => $perfil]);;
    }

    public function update(UpdatePerfilRequest $request, int $id)
    {
        if (!Gate::allows('perfil-update')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }

        #cria o DTO a partir dos dados validados
        $perfilData = $request->toDTO();

        #atualiza o usuário
        $this->updatePerfilUseCase->execute($id, $perfilData);

        return redirect()->route('roles.index')->with('success', 'Perfil atualizado com sucesso');
    }

    public function create(Request $request)
    {
        if (!Gate::allows('perfil-create')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }

        $features = PermissionService::getFeatures();
        return Inertia::render('Perfis/Form', ['features' => $features]);;
    }

    public function store(CreatePerfilRequest $request)
    {
        if (!Gate::allows('perfil-store')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $perfilData = $request->toDTO();
        $this->createPerfilUseCase->execute($perfilData);
        return redirect()->route('roles.index')->with('success', 'Perfil criado com sucesso');
    }

    public function destroy(int $id)
    {
        if (!Gate::allows('perfil-delete')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $this->deletePerfilUseCase->execute($id);
        return redirect()->route('roles.index')->with('success', 'Perfil deletado com sucesso');
    }

    public function openToComboBox()
    {
        return $this->getPerfisToComboBox->execute();
    }
}
