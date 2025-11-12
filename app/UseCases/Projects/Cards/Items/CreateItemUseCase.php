<?php

namespace App\UseCases\Projects\Cards\Items;

use App\DTOs\ProjectCardItemData;
use App\Repositories\Eloquent\ProjectCardItemRepository;

readonly class CreateItemUseCase
{
    public function __construct(private ProjectCardItemRepository $repository)
    {

    }

    public function execute(ProjectCardItemData $data)
    {
        $this->repository->create($data);
    }
}
