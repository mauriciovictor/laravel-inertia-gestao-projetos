<?php

use App\DTOs\ProjectCardItemData;
use App\Repositories\Eloquent\ProjectCardItemRepository;
use App\UseCases\Projects\Cards\Items\UpdateCardItemUseCase;

beforeEach(function () {
    $this->cardId = 1;
    $this->itemId = 1;
    $this->projectCardItemRepository = Mockery::mock(ProjectCardItemRepository::class);
    $this->useCase = new UpdateCardItemUseCase($this->projectCardItemRepository);
});

describe('CreateItemUseCaseTest', function () {
    it('move um item pra outro card', function () {
        $itemData = new ProjectCardItemData(
            card_id: $this->cardId,
            title: 'Novo Item',
            description: 'Descrição do novo item',
            priority: 'low'
        );

        $new_card_id = 2;

        $this
            ->projectCardItemRepository
            ->shouldReceive('updateProjectCardId')
            ->once()
            ->with($new_card_id, $this->itemId)
            ->andReturn((object)[
                'id' => $this->itemId,
                'card_id' => $new_card_id,  // Retorna com o novo card_id
                'title' => $itemData->title,
                'description' => $itemData->description,
                'priority' => $itemData->priority,
            ]);
        
        $result = $this->useCase->execute($new_card_id, $this->itemId);

        expect($result)
            ->toBeObject()
            ->and($result->id)->toBe($this->itemId)
            ->and($result->card_id)->toBe($new_card_id);
    });
});
