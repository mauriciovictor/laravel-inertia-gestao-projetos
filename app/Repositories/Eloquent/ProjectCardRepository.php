<?php

namespace App\Repositories\Eloquent;

use App\DTOs\ProjectCardData;
use App\Repositories\Eloquent\Models\ProjectCard;

class ProjectCardRepository
{
    public function __construct(private ProjectCard $model)
    {
    }

    public function create(ProjectCardData $data)
    {
        return $this->model->create($data->toArray());
    }

    public function update(int $id, ProjectCardData $data)
    {
        $this->model->find($id)->update($data->toArray());

        return $this->model->find($id);
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function findAllByProject(string $id)
    {
        return $this->model->get();
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
