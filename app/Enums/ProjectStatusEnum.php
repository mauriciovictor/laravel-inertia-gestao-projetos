<?php

namespace App\Enums;

enum ProjectStatusEnum: string
{
    case ACTIVE = 'active';
    case FINISHED = 'finished';
    case CANCELLED = 'cancelled';
    case PAUSED = 'paused';


    public function getLabel(): string
    {
        return match ($this) {
            self::ACTIVE => 'Ativo',
            self::FINISHED => 'Finalizado',
            self::CANCELLED => 'Cancelado',
            self::PAUSED => 'Pausado',
        };
    }
}
