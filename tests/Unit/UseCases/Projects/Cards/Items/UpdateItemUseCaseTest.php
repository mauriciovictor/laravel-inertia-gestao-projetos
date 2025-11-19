<?php

use App\DTOs\ProjectCardItemData;
use App\Repositories\Eloquent\ProjectCardItemRepository;
use App\UseCases\Projects\Cards\Items\UpdateItemUseCase;

beforeEach(function () {
    $this->cardId = 1;
    $this->itemId = 1;
    $this->projectCardItemRepository = Mockery::mock(ProjectCardItemRepository::class);
    $this->useCase = new UpdateItemUseCase($this->projectCardItemRepository);
});

describe('CreateItemUseCaseTest', function () {
    it('move um item pra outro card', function () {
        $itemData = new ProjectCardItemData(
            card_id: $this->cardId,
            title: 'Novo Item',
            description: 'Descrição do novo item',
            priority: 'low'
        );


        $this
            ->projectCardItemRepository
            ->shouldReceive('update')
            ->once()
            ->with($this->itemId, $itemData)
            ->andReturn((object)[
                'id' => $this->itemId,
                'card_id' => $this->cardId,
                'title' => $itemData->title,
                'description' => $itemData->description,
                'priority' => $itemData->priority,
            ]);


        $result = $this->useCase->execute($this->itemId, $itemData);

        expect($result)
            ->toBeObject()
            ->and($result->id)->toBe($this->itemId);
    });
});
