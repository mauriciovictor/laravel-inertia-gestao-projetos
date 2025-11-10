<?php

namespace App\UseCases\Projects;

use App\Repositories\Eloquent\ProjectRepository;

class DeleteProjectUseCase
{
    public function __construct(private ProjectRepository $projectRepository)
    {
    }

    public function execute(string $id)
    {
        return $this->projectRepository->delete($id);
    }
}
