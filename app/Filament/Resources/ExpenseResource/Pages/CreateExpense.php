<?php

namespace App\Filament\Resources\ExpenseResource\Pages;

use App\Filament\Resources\ExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateExpense extends CreateRecord
{
    protected static string $resource = ExpenseResource::class;
    
    protected static bool $canCreateAnother = false;

    protected function handleRecordCreation(array $data): Model
    {
        $model = static::getModel()::create($data);
        $data['title'] = 'Expense for ' . $model->expense_category->name;
        $data['datetime'] = \Carbon\Carbon::parse($model->date)->format('Y-m-d H:i:s');
        $data['type'] = 'debit';
        $data['amount'] = $model->amount;
        $data['description'] = $model->description;
        \App\Models\Transaction::create($data);
        return $model;
    }
}
