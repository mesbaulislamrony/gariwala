<?php

namespace App\Filament\Resources\FuelLogResource\Pages;

use App\Filament\Resources\FuelLogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateFuelLog extends CreateRecord
{
    protected static string $resource = FuelLogResource::class;
    
    protected static bool $canCreateAnother = false;

    protected function handleRecordCreation(array $data): Model
    {
        $model = static::getModel()::create($data);
        $data['title'] = 'Purchase Fuel for ' . $model->vehicle->metro->name . ' Metro ' . $model->vehicle->number;
        $data['datetime'] = \Carbon\Carbon::parse($model->date)->format('Y-m-d H:i:s');
        $data['type'] = 'debit';
        $data['amount'] = $model->total;
        $data['description'] = 'Purchase Fuel for ' . $model->vehicle->name . ' (' . $model->vehicle->brand->name . ' - ' . $model->vehicle->type->name . '); Number: ' . $model->vehicle->metro->name . ' Metro ' . $model->vehicle->number . '; Unit price:' . $model->price . ' per ltr; Purchase qty:' . $model->qty . ' ltr; Total:' . $model->total . ' ৳';
        \App\Models\Transaction::create($data);
        return $model;
    }
}
