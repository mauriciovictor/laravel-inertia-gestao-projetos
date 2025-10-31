<?php

namespace App\Http\Controllers\Perfis;

use App\UseCases\Perfis\GetPerfisUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class ListPerfilController
{
    public function __construct(
        private GetPerfisUseCase $getPerfisUseCase,
    )
    {
    }

    public function __invoke(Request $request): InertiaResponse
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
}
