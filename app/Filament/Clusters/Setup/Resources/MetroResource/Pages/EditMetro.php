<?php

namespace App\Filament\Clusters\Setup\Resources\MetroResource\Pages;

use App\Filament\Clusters\Setup\Resources\MetroResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMetro extends EditRecord
{
    protected static string $resource = MetroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * @return array<NavigationItem | NavigationGroup>
     */
    public function getSubNavigation(): array
    {
        if (filled($cluster = static::getCluster())) {
            return $this->generateNavigationItems($cluster::getClusteredComponents());
        }

        return [];
    }
}
