<?php

namespace App\Filament\Clusters\Setup\Resources\TypeResource\Pages;

use App\Filament\Clusters\Setup\Resources\TypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateType extends CreateRecord
{
    protected static string $resource = TypeResource::class;
    
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
