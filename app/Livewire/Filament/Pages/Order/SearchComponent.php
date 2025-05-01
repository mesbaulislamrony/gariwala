<?php

namespace App\Livewire\Filament\Pages\Order;

use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class SearchComponent extends Component implements HasForms
{
    use InteractsWithForms;

    #[\Livewire\Attributes\Url]
    public $filter = "";
    public ?array $filters = [];
    public ?array $search = [];

    public function mount(): void
    {
        parse_str($this->filter, $array);
        $this->form->fill(
            array_merge([
                'trip_date' => now(),
                'trip_type' => \App\Enums\TripTypeEnum::Oneway->value,
            ], $array)
        );
    }

    public function create()
    {
        //
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            \Filament\Forms\Components\Section::make()->schema([
                \Filament\Forms\Components\CheckboxList::make('types')
                    ->columns(2)
                    ->reactive()
                    ->afterStateUpdated(function ($state) {
                        $this->filters['types'] = $state;
                        $this->filter = \Illuminate\Support\Arr::query($this->filters);
                        $this->dispatch('dispatchFilteredVehicles', $this->filter);
                    })
                    ->options(\App\Models\Type::query()->pluck('name', 'slug')->toArray()),
                \Filament\Forms\Components\CheckboxList::make('brands')
                    ->columns(2)
                    ->reactive()
                    ->afterStateUpdated(function ($state) {
                        $this->filters['brands'] = $state;
                        $this->filter = \Illuminate\Support\Arr::query($this->filters);
                        $this->dispatch('dispatchFilteredVehicles', $this->filter);
                    })
                    ->options(\App\Models\Brand::query()->pluck('name', 'slug')->toArray()),
                \Filament\Forms\Components\CheckboxList::make('amenities')
                    ->columns(2)
                    ->reactive()
                    ->afterStateUpdated(function ($state) {
                        $this->filters['amenities'] = $state;
                        $this->filter = \Illuminate\Support\Arr::query($this->filters);
                        $this->dispatch('dispatchFilteredVehicles', $this->filter);
                    })
                    ->options(\App\Models\Amenity::query()->pluck('name', 'slug')->toArray()),
                \Filament\Forms\Components\CheckboxList::make('metros')
                    ->columns(2)
                    ->reactive()
                    ->afterStateUpdated(function ($state) {
                        $this->filters['metros'] = $state;
                        $this->filter = \Illuminate\Support\Arr::query($this->filters);
                        $this->dispatch('dispatchFilteredVehicles', $this->filter);
                    })
                    ->options(\App\Models\Metro::query()->pluck('name', 'slug')->toArray()),
            ]),
        ])->statePath('search');
    }

    public function render()
    {
        return view('livewire.filament.pages.order.search-component');
    }
}
