<?php

namespace App\UseCases\Projects;

use App\DTOs\ProjectData;
use App\Repositories\Eloquent\ProjectRepository;

class CreateProjectUseCase
{
    public function __construct(private ProjectRepository $projectRepository)
    {

    }

    public function execute(ProjectData $data)
    {
        return $this->projectRepository->create($data);
    }
}
