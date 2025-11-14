<?php

namespace App\Http\Controllers\Projects\Cards\Items;

use App\UseCases\Projects\Cards\Items\DeleteCardItemUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DeleteCardItemController
{
    public function __construct(
        private DeleteCardItemUseCase $useCase
    )
    {
    }

    public function __invoke(Request $request, string $project_id, int $card_id, int $item_id)
    {
        if (!Gate::allows('project-card-item-delete')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $this->useCase->execute($item_id);
        return redirect()->route('projects.cards.index', $project_id)->with('success', 'Item deletado com sucesso');
    }
}
