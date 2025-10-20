<?php

namespace App\DTOs;
class PerfilData
{
    public function __construct(public string $name, public array $permissions, public ?int $id = null)
    {
    }
}
