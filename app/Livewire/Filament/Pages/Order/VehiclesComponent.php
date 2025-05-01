<?php

namespace App\Livewire\Filament\Pages\Order;

use App\Models\Order;
use Livewire\Component;
use Filament\Forms\Form;
use Livewire\Attributes\On;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class VehiclesComponent extends Component implements HasForms
{
    use InteractsWithForms;

    #[\Livewire\Attributes\Url]
    public $filter = "";
    public $filtered_vehicles = [];
    public $booked_vehicles = [];

    public function mount()
    {
        $this->filteredVehicles($this->filter);
        $this->bookedVehicles();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            // 
        ]);
    }

    public function render()
    {
        return view('livewire.filament.pages.order.vehicles-component');
    }

    public function addToCart($vehicle_id)
    {
        parse_str($this->filter, $array);
        $vehicle = \App\Models\Vehicle::find($vehicle_id);
        $array = collect($array)->only('trip_date');
        if (Order::where('email', auth()->user()->email)->exists()) {
            $order = Order::where('email', auth()->user()->email)->first();
            $array = collect(json_decode($order->trip, true))->toArray();

            if (!in_array($vehicle_id, $this->booked_vehicles)) {
                $vehicle->brand = $vehicle->brand->name;
                $vehicle->model = $vehicle->name;
                $vehicle->type = $vehicle->type->name;
                $vehicle->number_plate = $vehicle->metro->name . ' Metro ' . $vehicle->number;
                $vehicle->amenities = $vehicle->amenities->pluck('name')->implode(', ');
                $array['vehicles'] = collect($array['vehicles'])->push($vehicle->only('id', 'model', 'type', 'brand', 'image', 'amenities', 'number_plate'))->toArray();
                Order::where('email', auth()->user()->email)->update([
                    'trip' => collect($array)->toJson()
                ]);
            }
            $this->dispatch('dispatchBookedVehicles');
            return true;
        }

        $vehicle->brand = $vehicle->brand->name;
        $vehicle->model = $vehicle->name;
        $vehicle->type = $vehicle->type->name;
        $vehicle->number_plate = $vehicle->metro->name . ' Metro ' . $vehicle->number;
        $vehicle->amenities = $vehicle->amenities->pluck('name')->implode(', ');
        $array->put('vehicles', [$vehicle->only('id', 'model', 'type', 'brand', 'image', 'amenities', 'number_plate')]);
        $trip = $array->toJson();

        Order::create([
            'email' => auth()->user()->email,
            'trip' => $trip
        ]);

        $this->dispatch('dispatchBookedVehicles');
        return true;
    }

    public function removeFromCart($vehicle_id)
    {
        $order = Order::where('email', auth()->user()->email)->first();
        $array = collect(json_decode($order->trip, true))->toArray();

        if (in_array($vehicle_id, $this->booked_vehicles)) {
            $array['vehicles'] = collect($array['vehicles'])->forget(collect($array['vehicles'])->search(fn($v) => $v['id'] == $vehicle_id));
            $trip = collect($array)->toJson();

            Order::where('email', auth()->user()->email)->update([
                'trip' => $trip
            ]);
        }
        $this->dispatch('dispatchBookedVehicles');
    }

    #[On('dispatchBookedVehicles')]
    public function bookedVehicles()
    {
        $order = Order::where('email', auth()->user()->email)->first();
        if (!$order) {
            return;
        }
        $vehicles = collect(json_decode($order->trip, true))->toArray()['vehicles'];
        $this->booked_vehicles = collect($vehicles)->pluck('id')->toArray();
        if (count($this->booked_vehicles) == 0) {
            $order->delete();
        }
    }

    #[On('dispatchFilteredVehicles')]
    public function filteredVehicles($filter)
    {
        $this->filter = $filter;
        parse_str($filter, $array);
        if (empty($array)) {
            return [];
        }
        $query = \App\Models\Vehicle::query();

        // Filter by vehicle types (many-to-many)
        if (!empty($array['types'])) {
            $query->whereHas('type', function ($q) use ($array) {
                $q->whereIn('slug', $array['types']); // or 'name'
            });
        }

        // Filter by brands (assuming 'brand' column or relation)
        if (!empty($array['brands'])) {
            $query->whereHas('brand', function ($q) use ($array) {
                $q->whereIn('slug', $array['brands']); // or 'name'
            });
        }

        // Filter by amenities (many-to-many)
        if (!empty($array['amenities'])) {
            foreach ($array['amenities'] as $amenity) {
                $query->whereHas('amenities', function ($q) use ($amenity) {
                    $q->where('slug', $amenity);
                });
            }
        }

        // Filter by metro location
        if (!empty($array['metros'])) {
            $query->whereHas('metro', function ($q) use ($array) {
                $q->whereIn('slug', $array['metros']); // or 'name'
            });
        }

        $this->filtered_vehicles = $query->get();
    }
}
