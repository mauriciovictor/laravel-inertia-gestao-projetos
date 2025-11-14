<?php

namespace App\Http\Controllers\Projects\Cards;

use App\Http\Requests\Projects\Cards\CreateCardRequest;
use App\UseCases\Projects\Cards\CreateProjectCardUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CreateCardController
{
    public function __construct(
        private CreateProjectCardUseCase $useCase,
    )
    {
    }

    public function __invoke(CreateCardRequest $request, string $project_id)
    {
        if (!Gate::allows('project-card-create')) {
            throw new \Exception('Sem autorização para acessar este recurso.');
        }
        
        $cardData = $request->toDTO();
        $this->useCase->execute($cardData);
        return redirect()->route('projects.cards.index', $project_id)->with('success', 'Card criada com sucesso');
    }
}
