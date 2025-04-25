<?php

namespace App\Filament\Clusters\Setup\Resources\MetroResource\Pages;

use App\Filament\Clusters\Setup\Resources\MetroResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMetro extends CreateRecord
{
    protected static string $resource = MetroResource::class;
    
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
