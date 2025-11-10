<?php

namespace App\UseCases\Projects;

use App\DTOs\ProjectData;
use App\Repositories\Eloquent\ProjectRepository;

class UpdateProjectUseCase
{
    public function __construct(private ProjectRepository $projectRepository)
    {

    }

    public function execute(string $id, ProjectData $data)
    {
        $this->projectRepository->update($id, $data);
    }
}
