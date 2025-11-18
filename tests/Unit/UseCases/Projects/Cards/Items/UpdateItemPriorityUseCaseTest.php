<?php

use App\DTOs\ProjectCardItemData;
use App\Repositories\Eloquent\ProjectCardItemRepository;
use App\UseCases\Projects\Cards\Items\UpdateItemPriorityUseCase;

beforeEach(function () {
    $this->cardId = 1;
    $this->itemId = 1;
    $this->projectCardItemRepository = Mockery::mock(ProjectCardItemRepository::class);
    $this->useCase = new UpdateItemPriorityUseCase($this->projectCardItemRepository);
});

describe('CreateItemUseCaseTest', function () {
    it('atualiza a prioridade de item', function () {
        $itemData = new ProjectCardItemData(
            card_id: $this->cardId,
            title: 'Novo Item',
            description: 'Descrição do novo item',
            priority: 'low'
        );

        $priority = 'high';

        $this
            ->projectCardItemRepository
            ->shouldReceive('updateItemPriority')
            ->once()
            ->with($this->itemId, $priority)
            ->andReturn((object)[
                'id' => $this->itemId,
                'card_id' => $itemData->card_id,  // Retorna com o novo card_id
                'title' => $itemData->title,
                'description' => $itemData->description,
                'priority' => $priority,
            ]);

        $result = $this->useCase->execute($this->itemId, $priority);

        expect($result)
            ->toBeObject()
            ->and($result->id)->toBe($this->itemId)
            ->and($result->priority)->toBe($priority);
    });
});
