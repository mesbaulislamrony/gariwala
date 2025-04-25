<?php

namespace App\Livewire\Filament\Pages\Order;

use Livewire\Attributes\On;
use Livewire\Component;

class VehiclesComponent extends Component
{
    public $vehicles;

    #[On('dispatchVehicles')]
    public function mount(): void
    {
        $this->vehicles = \App\Models\Vehicle::query()->get();
    }

    public function render()
    {
        return view('livewire.filament.pages.order.vehicles-component');
    }
}
