<?php

use App\DTOs\ProjectCardItemData;
use App\Repositories\Eloquent\ProjectCardItemRepository;
use App\UseCases\Projects\Cards\Items\CreateItemUseCase;
use App\UseCases\Projects\Cards\Items\DeleteCardItemUseCase;

beforeEach(function () {
    $this->cardId = 1;
    $this->itemId = 1;
    $this->projectCardItemRepository = Mockery::mock(ProjectCardItemRepository::class);
    $this->useCase = new DeleteCardItemUseCase($this->projectCardItemRepository);
});

describe('CreateItemUseCaseTest', function () {
    it('delete um item em um card', function () {


        $this
            ->projectCardItemRepository
            ->shouldReceive('delete')
            ->once()
            ->with($this->cardId)
            ->andReturn(true);

        $result = $this->useCase->execute($this->cardId);

        expect($result)->toBeTrue();
    });
});
