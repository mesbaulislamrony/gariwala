<?php

namespace App\Filament\Clusters\Setup\Resources\AmenityResource\Pages;

use App\Filament\Clusters\Setup\Resources\AmenityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAmenity extends CreateRecord
{
    protected static string $resource = AmenityResource::class;
    
    protected static bool $canCreateAnother = false;

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
