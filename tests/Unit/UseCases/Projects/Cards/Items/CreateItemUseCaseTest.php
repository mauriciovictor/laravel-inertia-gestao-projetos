<?php

use App\DTOs\ProjectCardItemData;
use App\Repositories\Eloquent\ProjectCardItemRepository;
use App\UseCases\Projects\Cards\Items\CreateItemUseCase;

beforeEach(function () {
    $this->cardId = 1;
    $this->itemId = 1;
    $this->projectCardItemRepository = Mockery::mock(ProjectCardItemRepository::class);
    $this->useCase = new CreateItemUseCase($this->projectCardItemRepository);
});

describe('CreateItemUseCaseTest', function () {
    it('cria um novo item em um card', function () {
        $itemData = new ProjectCardItemData(
            card_id: $this->cardId,
            title: 'Novo Item',
            description: 'Descrição do novo item',
            priority: 'low'
        );

        $this
            ->projectCardItemRepository
            ->shouldReceive('create')
            ->once()
            ->with($itemData)
            ->andReturn((object)[
                'id' => $this->itemId,
                'card_id' => $this->cardId,
                'title' => $itemData->title,
                'description' => $itemData->description,
                'priority' => $itemData->priority,
            ]);

        $result = $this->useCase->execute($itemData);

        expect($result)
            ->toBeObject()
            ->and($result->id)->toBe($this->itemId);
    });
});
