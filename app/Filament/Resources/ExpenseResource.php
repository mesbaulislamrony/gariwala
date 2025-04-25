<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Filament\Resources\ExpenseResource\RelationManagers;
use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('expense_category_id')
                        ->label('Expense Category')
                        ->options(\App\Models\ExpenseCategory::query()->pluck('name', 'id'))
                        ->required(),
                    Forms\Components\DatePicker::make('date')
                        ->required()
                        ->native(false)
                        ->displayFormat('d F Y')
                        ->default(now()),
                    Forms\Components\TextInput::make('amount')
                        ->prefix('৳')
                        ->required(),
                    Forms\Components\Textarea::make('description')
                        ->rows(5)
                        ->nullable(),
                ])->maxWidth('md'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('expense_category.name')
                    ->label('Expense Category')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->formatStateUsing(fn(string $state): string => \Carbon\Carbon::parse($state)->format('d F Y')),
                \Filament\Tables\Columns\TextColumn::make('amount'),
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
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}
