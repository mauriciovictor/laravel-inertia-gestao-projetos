<?php

namespace App\Repositories\Eloquent;

use App\DTOs\ProjectData;
use App\Repositories\Eloquent\Models\Project;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Str;

class ProjectRepository
{
    public function __construct(private Project $model)
    {
    }

    public function create(ProjectData $data)
    {
        $data = $data->toArray();
        $data['id'] = Str::uuid()->toString();

        return $this->model->create($data);
    }

    public function update(string $id, ProjectData $data)
    {
        $this->model->find($id)->update($data->toArray());

        return $this->model->find($id);
    }

    public function findById(string $id)
    {
        return $this->model->find($id);
    }

    public function allPaged(int $page = 1, int $per_page = 5): AbstractPaginator
    {
        return $this->model->paginate(perPage: $per_page, page: $page);
    }
}
