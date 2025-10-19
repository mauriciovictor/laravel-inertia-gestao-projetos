<?php

namespace App\UseCases\Users;

use App\Repositories\Eloquent\UserRepository;
use Illuminate\Pagination\AbstractPaginator;

class GetUsersUseCase
{

    public function __construct(private UserRepository $userRepository)
    {
    }

    public function execute(
        array  $fieldsFilters,
        array  $filterValues,
        array  $fieldSortValues,
        string $search = '',
        int    $page = 1,
        int    $per_page = 5,
        array  $appends): AbstractPaginator
    {
        return $this->userRepository->allPaged($fieldsFilters, $filterValues, $fieldSortValues, $search, $page, $per_page, $appends);
    }
}
