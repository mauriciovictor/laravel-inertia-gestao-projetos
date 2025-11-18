<?php

namespace App\UseCases\Projects\Cards\Items;

use App\Repositories\Eloquent\ProjectCardItemRepository;

class DeleteCardItemUseCase
{
    public function __construct(private ProjectCardItemRepository $repository)
    {

    }

    public function execute(int $id)
    {
        return $this->repository->delete($id);
    }
}
