<?php

namespace App\Filament\Clusters\Setup\Resources\AmenityResource\Pages;

use App\Filament\Clusters\Setup\Resources\AmenityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAmenity extends EditRecord
{
    protected static string $resource = AmenityResource::class;

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
