<?php

namespace App\DTOs;

use App\Enums\ProjectStatusEnum;

class ProjectCardData
{
    public function __construct(
        public string $project_id,
        public string $title,
        public string $description,
    )
    {

    }

    public function toArray(): array
    {
        return [
            'project_id' => $this->project_id,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
