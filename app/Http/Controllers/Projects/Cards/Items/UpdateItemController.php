<?php

namespace App\Http\Controllers\Projects\Cards\Items;

use App\Http\Requests\Projects\Cards\Items\UpdateCardItemRequest;
use App\UseCases\Projects\Cards\Items\UpdateItemUseCase;
use Illuminate\Support\Facades\Gate;

readonly class UpdateItemController
{
    public function __construct(
        private UpdateItemUseCase $useCase,
    )
    {
    }

    public function __invoke(UpdateCardItemRequest $request, string $project_id, int $card_id, int $item_id)
    {
        if (!Gate::allows('project-card-item-update')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $cardData = $request->toDTO();
        $this->useCase->execute($item_id, $cardData);
        return redirect()->route('projects.cards.index', $project_id)->with('success', 'Item alterado com sucesso');
    }
}
