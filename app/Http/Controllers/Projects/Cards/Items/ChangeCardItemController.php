<?php

namespace App\Http\Controllers\Projects\Cards\Items;

use App\UseCases\Projects\Cards\Items\UpdateCardItemUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ChangeCardItemController
{
    public function __construct(
        private UpdateCardItemUseCase $useCase
    )
    {
    }

    public function __invoke(Request $request)
    {
        if (!Gate::allows('project-card-item-update')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $item_id = $request->input('item_id');
        $project_card_id = $request->input('project_card_id');

        $this->useCase->execute($project_card_id, $item_id);

        return redirect()->back()->with('success', 'Item movido com sucesso');
    }
}
