<?php

namespace App\Enums;

enum PaymentMethodEnum: string
{
    case Cash = 'cash';
    case Card = 'card';
    case Online = 'online';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Cash => 'Cash',
            self::Card => 'Card',
            self::Online => 'Online',
        };
    }
}
