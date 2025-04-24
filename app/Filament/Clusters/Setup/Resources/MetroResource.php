<?php

namespace App\Filament\Clusters\Setup\Resources;

use App\Filament\Clusters\Setup;
use App\Filament\Clusters\Setup\Resources\MetroResource\Pages;
use App\Filament\Clusters\Setup\Resources\MetroResource\RelationManagers;
use App\Models\Metro;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MetroResource extends Resource
{
    protected static ?string $model = Metro::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Setup::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('name')->required(),
                ])->maxWidth('md'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListMetros::route('/'),
            'create' => Pages\CreateMetro::route('/create'),
            'edit' => Pages\EditMetro::route('/{record}/edit'),
        ];
    }
}
