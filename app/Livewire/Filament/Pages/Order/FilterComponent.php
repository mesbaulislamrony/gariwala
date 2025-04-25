<?php

namespace App\Livewire\Filament\Pages\Order;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class FilterComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'pickup_address' => 'Dhaka',
            'drop_address' => 'Khulna',
            'trip_date' => now(),
            'trip_type' => \App\Enums\TripTypeEnum::Oneway->value,
        ]);
    }

    public function create()
    {
        $this->dispatch('dispatchVehicles', $this->form->getState());
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            \Filament\Forms\Components\Grid::make()->schema([
                \Filament\Forms\Components\TextInput::make('pickup_address')
                    ->required(),
                \Filament\Forms\Components\TextInput::make('drop_address')
                    ->required(),
                \Filament\Forms\Components\DatePicker::make('trip_date')
                    ->required()
                    ->native(false)
                    ->displayFormat('d F Y')
                    ->default(now()),
                \Filament\Forms\Components\Select::make('trip_type')
                    ->options(collect(\App\Enums\TripTypeEnum::cases())->pluck('name', 'value')->toArray())
                    ->required(),
            ]),
            \Filament\Forms\Components\CheckboxList::make('types')
                ->columns(2)
                ->options(\App\Models\Type::query()->pluck('name', 'slug')->toArray()),
            \Filament\Forms\Components\CheckboxList::make('brands')
                ->columns(2)
                ->options(\App\Models\Brand::query()->pluck('name', 'slug')->toArray()),
            \Filament\Forms\Components\CheckboxList::make('amenities')
                ->columns(2)
                ->options(\App\Models\Amenity::query()->pluck('name', 'slug')->toArray()),
            \Filament\Forms\Components\CheckboxList::make('metros')
                ->columns(2)
                ->options(\App\Models\Metro::query()->pluck('name', 'slug')->toArray()),
        ])->statePath('data');
    }

    public function render()
    {
        return view('livewire.filament.pages.order.filter-component');
    }
}
