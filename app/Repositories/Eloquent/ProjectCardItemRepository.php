<?php

namespace App\Repositories\Eloquent;

use App\DTOs\ProjectCardItemData;
use App\Repositories\Eloquent\Models\ProjectCardItem;

class ProjectCardItemRepository
{
    public function __construct(private ProjectCardItem $model)
    {
    }

    public function create(ProjectCardItemData $data)
    {
        return $this->model->create($data->toArray());
    }

    public function update(int $id, ProjectCardItemData $data)
    {
        $this->model->find($id)->update($data->toArray());

        return $this->model->find($id);
    }

    public function updateProjectCardId(int $card_id, int $item_id)
    {
        $this->model->find($item_id)->update([
            'project_card_id' => $card_id,
        ]);

        return $this->model->find($item_id);
    }

    public function updateItemPriority(int $item_id, string $priority)
    {
        $this->model->find($item_id)->update([
            'priority' => $priority,
        ]);
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function findByCardId(string $card_id)
    {
        return $this->model->where('card_id', $card_id)->get();
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
