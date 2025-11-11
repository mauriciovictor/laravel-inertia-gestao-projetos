<?php

namespace App\Http\Controllers\Projects\Cards;

use App\Http\Requests\Projects\Cards\CreateCardRequest;
use App\UseCases\Projects\Cards\CreateProjectCardUseCase;
use App\UseCases\Projects\Cards\DeleteProjectCardUseCase;
use App\UseCases\Projects\Cards\UpdateProjectCardUseCase;
use Illuminate\Http\Request;

class DeleteCardController
{
    public function __construct(
        private DeleteProjectCardUseCase $useCase,
    )
    {
    }

    public function __invoke(Request $request, string $project_id, int $card_id)
    {
        $this->useCase->execute($card_id);
        return redirect()->route('projects.cards.index', $project_id)->with('success', 'Card deletado com sucesso');
    }
}
