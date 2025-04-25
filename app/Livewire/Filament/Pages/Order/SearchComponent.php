<?php

namespace App\Livewire\Filament\Pages\Order;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class SearchComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'pickup_address' => 'Dhaka',
            'drop_address' => 'Khulna',
            'pickup_date' => now(),
        ]);
    }
    
    public function create()
    {
        $this->dispatch('dispatchVehicles');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            \Filament\Forms\Components\Grid::make(5)->schema([
                \Filament\Forms\Components\TextInput::make('pickup_address')
                    ->columnSpan(2)
                    ->required(),
                \Filament\Forms\Components\TextInput::make('drop_address')
                    ->columnSpan(2)
                    ->required(),
                \Filament\Forms\Components\DatePicker::make('pickup_date')
                    ->required()
                    ->native(false)
                    ->displayFormat('d F Y')
                    ->default(now()),
            ]),
        ])->statePath('data');
    }

    public function render()
    {
        return view('livewire.filament.pages.order.search-component');
    }
}
