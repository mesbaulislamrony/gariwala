<div>
    @foreach($vehicles as $vehicle)
        <div>
            <h3>{{ $vehicle->name }}</h3>
            <p>{{ $vehicle->description }}</p>
            <x-filament::button type="button" wire:click="create">Add to Cart</x-filament::button>
        </div>
    @endforeach
</div>
