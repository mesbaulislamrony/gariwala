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
        return $form->schema([])->statePath('data');
    }

    public function render()
    {
        return view('livewire.filament.pages.order.search-component');
    }
}
