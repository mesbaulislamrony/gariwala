<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Checkout extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.checkout';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
