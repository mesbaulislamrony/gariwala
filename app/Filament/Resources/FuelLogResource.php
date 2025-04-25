<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FuelLogResource\Pages;
use App\Filament\Resources\FuelLogResource\RelationManagers;
use App\Models\FuelLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FuelLogResource extends Resource
{
    protected static ?string $model = FuelLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form->schema([
            \Filament\Forms\Components\Section::make()->schema([
                \Filament\Forms\Components\DatePicker::make('date')
                    ->required()
                    ->native(false)
                    ->displayFormat('d F Y')
                    ->default(now()),
                \Filament\Forms\Components\Select::make('vehicle_id')
                    ->label('Vehicle')
                    ->options(\App\Models\Vehicle::all()->pluck('name', 'id'))
                    ->required(),
                \Filament\Forms\Components\Grid::make()->schema([
                    \Filament\Forms\Components\Select::make('fuel_type')
                        ->label('Fuel Type')
                        ->options(collect(\App\Enums\FualType::cases())->pluck('name', 'value')->toArray())
                        ->required(),
                    \Filament\Forms\Components\TextInput::make('odometer')
                        ->required(),
                ]),
                \Filament\Forms\Components\Grid::make(3)->schema([
                    \Filament\Forms\Components\TextInput::make('price')
                        ->prefix('৳')
                        ->required(),
                    \Filament\Forms\Components\TextInput::make('qty')
                        ->suffix('.ltr')
                        ->required(),
                    \Filament\Forms\Components\TextInput::make('total')
                        ->prefix('৳')
                        ->required(),
                ]),
                \Filament\Forms\Components\Textarea::make('note')
                    ->rows(5),
            ])->maxWidth('2xl'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('vehicle.name')
                    ->description(fn(FuelLog $record): string => $record->fuel_type)
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('total')
                    ->description(fn(FuelLog $record): string => $record->price . 'x' . $record->qty . ' ltr')
                    ->label('Cost'),
                \Filament\Tables\Columns\TextColumn::make('odometer')
                    ->formatStateUsing(fn(string $state): string => number_format($state) . ' km')
                    ->label('Odometer'),
                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->formatStateUsing(fn(string $state): string => \Carbon\Carbon::parse($state)->diffForHumans())
                    ->label('Last Updated'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFuelLogs::route('/'),
            'create' => Pages\CreateFuelLog::route('/create'),
            'edit' => Pages\EditFuelLog::route('/{record}/edit'),
        ];
    }
}
