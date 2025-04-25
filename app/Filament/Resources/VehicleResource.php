<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form->schema([
            \Filament\Forms\Components\Grid::make(5)->schema([
                \Filament\Forms\Components\Section::make()->schema([
                    \Filament\Forms\Components\Grid::make(3)->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->required()
                            ->columnSpan(2),
                        \Filament\Forms\Components\TextInput::make('number')
                            ->required(),
                    ]),
                    \Filament\Forms\Components\RichEditor::make('description')
                        ->required(),
                    \Filament\Forms\Components\Grid::make()->schema([
                        \Filament\Forms\Components\TextInput::make('odometer')
                            ->required(),
                        \Filament\Forms\Components\Select::make('status')
                            ->options(collect(\App\Enums\VehicleStatus::cases())->pluck('name', 'value')->toArray())
                            ->required(),
                    ]),
                    \Filament\Forms\Components\CheckboxList::make('amenities')
                        ->options(\App\Models\Amenity::all()->pluck('name', 'id')->toArray())
                        ->bulkToggleable()
                        ->relationship('amenities', 'name')
                        ->columns(3)
                        ->gridDirection('row')
                        ->required(),
                ])->columnSpan(3),
                \Filament\Forms\Components\Section::make()->schema([
                    \Filament\Forms\Components\Select::make('type_id')
                        ->relationship('type', 'name')
                        ->required(),
                    \Filament\Forms\Components\Select::make('metro_id')
                        ->relationship('metro', 'name')
                        ->required(),
                    \Filament\Forms\Components\Select::make('brand_id')
                        ->relationship('brand', 'name')
                        ->required(),
                ])->columnSpan(2),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->description(fn(Vehicle $record): string => $record->metro->name . ' Metro ' . $record->number)
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('brand.name')
                    ->description(fn(Vehicle $record): string => $record->type->name)
                    ->label('Brand'),
                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->formatStateUsing(fn(string $state): string => \Carbon\Carbon::parse($state)->diffForHumans())
                    ->label('Last Updated'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            \App\Filament\Resources\VehicleResource\RelationManagers\UserVehicleRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'view' => Pages\ViewVehicle::route('/{record}'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
