<?php

namespace App\Http\Controllers\Projects\Cards\Items;

use App\UseCases\Projects\Cards\Items\UpdateCardItemUseCase;
use App\UseCases\Projects\Cards\Items\UpdateItemPriorityUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

readonly class ChangeItemPriorityController
{
    public function __construct(
        private UpdateItemPriorityUseCase $useCase
    )
    {
    }

    public function __invoke(Request $request, string $project_id)
    {
        if (!Gate::allows('project-card-item-update')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $item_id = $request->input('item_id');
        $priority = $request->input('priority');

        $this->useCase->execute($item_id, $priority);
        return redirect()->route('projects.cards.index', $project_id)->with('success', 'Prioridade alterada com sucesso');
    }
}
