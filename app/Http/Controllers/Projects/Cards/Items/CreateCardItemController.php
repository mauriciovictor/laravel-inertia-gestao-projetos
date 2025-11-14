<?php

namespace App\Http\Controllers\Projects\Cards\Items;

use App\Http\Requests\Projects\Cards\CreateCardRequest;
use App\Http\Requests\Projects\Cards\Items\CreateCardItemRequest;
use App\UseCases\Projects\Cards\CreateProjectCardUseCase;
use App\UseCases\Projects\Cards\Items\CreateItemUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CreateCardItemController
{
    public function __construct(
        private CreateItemUseCase $useCase,
    )
    {
    }

    public function __invoke(CreateCardItemRequest $request, string $project_id, int $card_id)
    {
        if (!Gate::allows('project-card-item-create')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        $cardData = $request->toDTO();
        $this->useCase->execute($cardData);

        return redirect()->route('projects.cards.index', $project_id)->with('success', 'Item criada com sucesso');
    }
}
