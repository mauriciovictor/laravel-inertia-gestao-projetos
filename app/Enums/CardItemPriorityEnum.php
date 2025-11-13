<?php

namespace App\Enums;

enum CardItemPriorityEnum: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public function getLabel(): string
    {
        return match ($this) {
            self::LOW => 'Baixa',
            self::MEDIUM => 'Médio',
            self::HIGH => 'Alta',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::LOW => 'bg-white/60 text-cyan-600',
            self::MEDIUM => 'bg-white/60 text-orange-900 font-bold',
            self::HIGH => 'bg-white/60 text-red-600',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::LOW => 'pi pi-arrow-down',
            self::MEDIUM => 'pi pi-minus',
            self::HIGH => 'pi pi-arrow-up',
        };
    }

    public static function mountedPriorities(): array
    {
        return array_map(fn($priority) => [
            'code' => $priority->value,
            'name' => $priority->getLabel(),
            'color' => $priority->getColor(),
            'icon' => $priority->getIcon(),
        ], self::cases());
    }
}
