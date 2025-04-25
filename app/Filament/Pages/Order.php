<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Enums\MaxWidth;

class Order extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.order';

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }
}
