<?php

namespace App\Http\Controllers\Projects\Cards\Items;

use App\UseCases\Projects\Cards\Items\UpdateCardItemUseCase;
use App\UseCases\Projects\Cards\Items\UpdateItemPriorityUseCase;
use Illuminate\Http\Request;

readonly class ChangeItemPriorityController
{
    public function __construct(
        private UpdateItemPriorityUseCase $useCase
    )
    {
    }

    public function __invoke(Request $request): \Illuminate\Http\RedirectResponse
    {
        $item_id = $request->input('item_id');
        $priority = $request->input('priority');

        $this->useCase->execute($item_id, $priority);

        return redirect()->back()->with('success', 'Prioridade alterada com sucesso');
    }
}
