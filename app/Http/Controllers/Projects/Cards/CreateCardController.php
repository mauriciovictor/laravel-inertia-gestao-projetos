<?php

namespace App\Http\Controllers\Projects\Cards;

use App\Http\Requests\Projects\Cards\CreateCardRequest;
use App\UseCases\Projects\Cards\CreateProjectCardUseCase;
use Illuminate\Http\Request;

class CreateCardController
{
    public function __construct(
        private CreateProjectCardUseCase $useCase,
    )
    {
    }

    public function __invoke(CreateCardRequest $request, string $project_id)
    {
        $cardData = $request->toDTO();
        $this->useCase->execute($cardData);
        return redirect()->route('projects.cards.index', $project_id)->with('success', 'Card criada com sucesso');
    }
}
