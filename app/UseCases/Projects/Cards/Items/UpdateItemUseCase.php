<?php

namespace App\UseCases\Projects\Cards\Items;

use App\DTOs\ProjectCardItemData;
use App\Repositories\Eloquent\ProjectCardItemRepository;

readonly class UpdateItemUseCase
{
    public function __construct(private ProjectCardItemRepository $repository)
    {
    }

    public function execute(int $item_id, ProjectCardItemData $data): void
    {
        $this->repository->update($item_id, $data);
    }
}
