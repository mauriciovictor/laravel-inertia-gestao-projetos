<?php

namespace App\Http\Controllers\Perfis;

use App\UseCases\Perfis\GetPerfisToComboBox;

class ListToComboBoxController
{
    public function __construct(
        private GetPerfisToComboBox $getPerfisToComboBox,
    )
    {
    }

    public function __invoke()
    {
        return $this->getPerfisToComboBox->execute();
    }
}
