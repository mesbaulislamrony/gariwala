<?php

namespace App\Filament\Clusters\Setup\Resources\ExpenseCategoryResource\Pages;

use App\Filament\Clusters\Setup\Resources\ExpenseCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExpenseCategory extends CreateRecord
{
    protected static string $resource = ExpenseCategoryResource::class;
}
