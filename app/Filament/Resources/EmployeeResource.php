<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Employees';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Grid::make(5)->schema([
                    \Filament\Forms\Components\Section::make()->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->required(),
                        \Filament\Forms\Components\Grid::make(3)->schema([
                            \Filament\Forms\Components\TextInput::make('email')
                                ->required()
                                ->email()
                                ->columnSpan(2),
                            \Filament\Forms\Components\Group::make()->relationship('payroll') 
                                ->schema([
                                    \Filament\Forms\Components\DatePicker::make('joining_date')
                                        ->required()
                                        ->native(false)
                                        ->displayFormat('d F Y')
                                        ->default(now()),
                                ]),
                        ]),
                        \Filament\Forms\Components\Grid::make(2)->schema([
                            \Filament\Forms\Components\TextInput::make('password')
                                ->dehydrated(fn (?string $state): bool => filled($state))
                                ->required(fn (string $operation): bool => $operation === 'create') 
                                ->password()
                                ->revealable(),
                            \Filament\Forms\Components\TextInput::make('password_confirmation')
                                ->dehydrated(fn (?string $state): bool => filled($state))
                                ->required(fn (string $operation): bool => $operation === 'create')
                                ->password()
                                ->revealable(),
                        ]),
                    ])->columnSpan(3),
                    \Filament\Forms\Components\Section::make('Setup Payroll')->schema([
                        \Filament\Forms\Components\Group::make()->relationship('payroll') 
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('basic_salary')
                                    ->required(),
                                \Filament\Forms\Components\Grid::make()->schema([
                                    \Filament\Forms\Components\TextInput::make('allowance')
                                        ->required(),
                                    \Filament\Forms\Components\TextInput::make('commission_rate')
                                        ->required(),
                                ]),
                                \Filament\Forms\Components\TextInput::make('net_salary')
                                    ->required(),
                                \Filament\Forms\Components\Textarea::make('note')
                                    ->rows(3),
                            ]),
                    ])->columnSpan(2),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->description(fn(User $record): string => $record->email)
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('email_verified_at')
                    ->label('Verified'),
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', 'employee');
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
