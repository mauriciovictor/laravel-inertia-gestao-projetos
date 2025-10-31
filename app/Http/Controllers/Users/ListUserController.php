<?php

namespace App\Http\Controllers\Users;

use App\UseCases\Users\GetUsersUseCase;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Support\Facades\Gate;

class ListUserController
{
    public function __construct(
        private GetUsersUseCase $getUsersUseCase,
    )
    {
    }

    public function __invoke(Request $request): InertiaResponse
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
}
