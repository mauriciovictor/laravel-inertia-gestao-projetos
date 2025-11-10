<?php

namespace App\UseCases\Projects;

use App\Repositories\Eloquent\ProjectRepository;

class ListProjectsUseCase
{
    public function __construct(
        private ProjectRepository $projectRepository,
    )
    {
    }

    public function execute($page, $per_page): \Illuminate\Pagination\AbstractPaginator
    {
        return $this->projectRepository->allPaged(
            page: $page,
            per_page: $per_page,
        );
    }
}
