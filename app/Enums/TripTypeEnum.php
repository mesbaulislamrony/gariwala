<?php

namespace App\Enums;

enum TripTypeEnum: string
{
    case Oneway = 'oneway';
    case Round = 'round';
    case Contractual = 'contractual';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Oneway => 'Oneway Trip',
            self::Round => 'Round Trip',
            self::Contractual => 'Contractual Trip',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Oneway => 'heroicon-o-calendar-week',
            self::Round => 'heroicon-o-calendar-month',
            self::Contractual => 'heroicon-o-calendar',
        };
    }
}
