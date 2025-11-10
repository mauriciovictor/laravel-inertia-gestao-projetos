<?php

namespace App\DTOs;

use App\Enums\ProjectStatusEnum;

class ProjectData
{
    public function __construct(
        public string            $title,
        public string            $description,
        public ProjectStatusEnum $status,
    )
    {

    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status->value,
        ];
    }
}
