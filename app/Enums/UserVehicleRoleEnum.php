<?php

namespace App\Enums;

enum UserVehicleRoleEnum: string
{
    case Partner = 'partner';
    case Driver = 'driver';
    case Helper = 'helper';

    public function getLabel(): ?string
    {
        return match($this) {
            self::Partner => 'Partner',
            self::Driver => 'Driver',
            self::Helper => 'Helper',
        };
    }
}
