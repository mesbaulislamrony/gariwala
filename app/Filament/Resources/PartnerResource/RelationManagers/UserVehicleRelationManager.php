<?php

namespace App\Filament\Resources\PartnerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserVehicleRelationManager extends RelationManager
{
    protected static string $relationship = 'vehicles';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vehicle.name')
                    ->description(fn(\App\Models\UserVehicle $record): string => $record->vehicle->number)
                    ->label('Vehicle'),
                \Filament\Tables\Columns\TextColumn::make('vehicle.brand.name')
                    ->description(fn(\App\Models\UserVehicle $record): string => $record->vehicle->type->name)
                    ->label('Brand'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
