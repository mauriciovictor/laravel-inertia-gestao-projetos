<?php

namespace App\UseCases\Perfis;

use App\Repositories\Eloquent\RoleRepository;
use Illuminate\Pagination\AbstractPaginator;

class GetPerfisUseCase
{
    public function __construct(private RoleRepository $roleRepository)
    {
    }

    public function execute(
        array  $fieldsFilters,
        array  $filterValues,
        array  $fieldSortValues,
        string $search = '',
        int    $page = 1,
        int    $per_page = 5,
        array  $appends = []): AbstractPaginator
    {
        return $this->roleRepository->allPaged($fieldsFilters, $filterValues, $fieldSortValues, $search, $page, $per_page, $appends);
    }
}
