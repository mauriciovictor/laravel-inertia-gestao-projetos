<?php

namespace App\Http\Controllers\Projects\Cards;

use App\Http\Requests\Projects\Cards\CreateCardRequest;
use App\UseCases\Projects\Cards\CreateProjectCardUseCase;
use App\UseCases\Projects\Cards\UpdateProjectCardUseCase;
use Illuminate\Http\Request;

class UpdateCardController
{
    public function __construct(
        private UpdateProjectCardUseCase $useCase,
    )
    {
    }

    public function __invoke(CreateCardRequest $request, string $project_id, int $card_id)
    {
        $cardData = $request->toDTO();
        $this->useCase->execute($card_id, $cardData);
        return redirect()->route('projects.cards.index', $project_id)->with('success', 'Card atualizado com sucesso');
    }
}
