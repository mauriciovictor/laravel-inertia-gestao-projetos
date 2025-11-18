<?php

namespace App\UseCases\Projects\Cards\Items;

use App\Repositories\Eloquent\ProjectCardItemRepository;

class UpdateCardItemUseCase
{
    public function __construct(private ProjectCardItemRepository $repository)
    {
    }

    public function execute(int $card_id, int $item_id)
    {
        return $this->repository->updateProjectCardId($card_id, $item_id);
    }
}
