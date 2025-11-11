<?php

namespace App\Services;

use App\Repositories\Eloquent\ProjectRepository;

class ProjectService
{
    function __construct(
        private ProjectRepository $projectRepository,
    )
    {
    }

    public function findById(string $id)
    {
        return $this->projectRepository->findById($id);
    }
}
