<?php

namespace App\Filament\Clusters\Setup\Resources\MetroResource\Pages;

use App\Filament\Clusters\Setup\Resources\MetroResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMetros extends ListRecords
{
    protected static string $resource = MetroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
