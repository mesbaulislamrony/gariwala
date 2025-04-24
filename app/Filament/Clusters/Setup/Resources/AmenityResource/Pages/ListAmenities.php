<?php

namespace App\Filament\Clusters\Setup\Resources\AmenityResource\Pages;

use App\Filament\Clusters\Setup\Resources\AmenityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAmenities extends ListRecords
{
    protected static string $resource = AmenityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
