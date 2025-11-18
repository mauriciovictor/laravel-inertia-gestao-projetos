<?php

namespace App\UseCases\Projects\Cards\Items;

use App\Repositories\Eloquent\ProjectCardItemRepository;

class UpdateItemPriorityUseCase
{
    public function __construct(private ProjectCardItemRepository $repository)
    {
    }

    public function execute(int $item_id, string $priority)
    {
        return $this->repository->updateItemPriority($item_id, $priority);
    }
}
