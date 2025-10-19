<?php

namespace App\Enums;

enum FilterTypeEnum: string
{
    case CONTAINS = 'contains';
    case NOT_CONTAINS = 'notContains';
    case EQUALS = 'equals';
    case NOT_EQUALS = 'notEquals';
    case STARTS_WITH = 'startsWith';
    case ENDS_WITH = 'endsWith';

    public function getOperator(): string
    {
        return match ($this) {
            self::CONTAINS => 'like',
            self::NOT_CONTAINS => 'not like',
            self::EQUALS => '=',
            self::NOT_EQUALS => '!=',
            self::STARTS_WITH => 'like',
            self::ENDS_WITH => 'like',
        };
    }

    public function getOperatorValue($value): string
    {
        return match ($this) {
            self::CONTAINS => "%{$value}%",
            self::NOT_CONTAINS => "%{$value}%",
            self::EQUALS => $value,
            self::NOT_EQUALS => $value,
            self::STARTS_WITH => "{$value}%",
            self::ENDS_WITH => "%{$value}",
        };
    }
}
