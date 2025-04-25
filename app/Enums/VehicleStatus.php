<?php

namespace App\Enums;

enum VehicleStatus: string
{
    case Pending = 'pending';
    case Running = 'running';
    case Closed = 'closed';

    public function getLabel(): ?string
    {
        return match($this) {
            self::Pending => 'Pending',
            self::Running => 'Running',
            self::Closed => 'Closed',
        };
    }

    public function getIcon(): string
    {
        return match($this) {
            self::Pending => 'heroicon-o-calendar-week',
            self::Running => 'heroicon-o-calendar-month',
            self::Closed => 'heroicon-o-calendar',
        };
    }
}
