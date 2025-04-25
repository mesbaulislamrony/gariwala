<?php

namespace App\Livewire\Filament\Pages\Order;

use Livewire\Attributes\On;
use Livewire\Component;

class VehiclesComponent extends Component
{
    public $vehicles;

    public function mount(): void
    {
        $this->vehicles = \App\Models\Vehicle::with('amenities')->get();
    }

    #[On('dispatchVehicles')]
    public function dispatchVehicles($data): void
    {
        $this->vehicles = $this->getVehicles($data);
    }

    public function render()
    {
        return view('livewire.filament.pages.order.vehicles-component');
    }

    private function getVehicles($data)
    {
        $query = \App\Models\Vehicle::query();

        // Filter by vehicle types (many-to-many)
        if (!empty($data['types'])) {
            $query->whereHas('type', function ($q) use ($data) {
                $q->whereIn('slug', $data['types']); // or 'name'
            });
        }

        // Filter by brands (assuming 'brand' column or relation)
        if (!empty($data['brands'])) {
            $query->whereHas('brand', function ($q) use ($data) {
                $q->whereIn('slug', $data['brands']); // or 'name'
            });
        }

        // Filter by amenities (many-to-many)
        if (!empty($data['amenities'])) {
            foreach ($data['amenities'] as $amenity) {
                $query->whereHas('amenities', function ($q) use ($amenity) {
                    $q->where('slug', $amenity);
                });
            }
        }

        // Filter by metro location
        if (!empty($data['metros'])) {
            $query->whereHas('metro', function ($q) use ($data) {
                $q->whereIn('slug', $data['metros']); // or 'name'
            });
        }

        return $query->get();
    }
}
