<?php

namespace App\DTOs;

use App\Enums\ProjectStatusEnum;

class ProjectCardItemData
{
    public function __construct(
        public int    $card_id,
        public string $title,
        public string $description,
        public string $priority,
    )
    {

    }

    public function toArray(): array
    {
        return [
            'project_card_id' => $this->card_id,
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
        ];
    }
}
