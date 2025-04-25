<?php

namespace App\Enums;

enum FualType: string
{
    case Petrol = 'petrol';
    case Diesel = 'diesel';
    case Octane = 'octane';
    case Cng = 'cng';

    public function getLabel(): ?string
    {
        return match($this) {
            self::Petrol => 'Petrol',
            self::Diesel => 'Diesel',
            self::Octane => 'Octane',
            self::Cng => 'Cng',
        };
    }

    public function getUnit(): string
    {
        return match($this) {
            self::Petrol => 'Ltr',
            self::Diesel => 'Ltr',
            self::Octane => 'Ltr',
            self::Cng => 'Ltr',
        };
    }
}
