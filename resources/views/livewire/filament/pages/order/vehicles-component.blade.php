<x-filament::section>
    <x-slot name="heading">Search Result ({{ count($filtered_vehicles) }})</x-slot>
    <x-slot name="headerEnd">
        <x-filament::button tag="a" href="{{ route('filament.employee.pages.checkout') }}" badge-color="danger">
            Checkout ({{ count($booked_vehicles) }})
        </x-filament::button>
    </x-slot>
    @if(!empty($filtered_vehicles))
    @foreach($filtered_vehicles as $vehicle)
    <div class="flex justify-between gap-x-6">
        <div class="flex gap-x-3 items-center cursor-pointer mb-3">
            <img class="h-16 w-16 flex-none rounded-xl bg-gray-50" src="{{ asset($vehicle->image) }}" alt="">
            <div class="min-w-0 flex-auto">
                <p class="text-sm font-semibold text-gray-900 truncate">{{ $vehicle->brand->name }} {{ $vehicle->name }} {{ $vehicle->type->name }}</p>
                <p class="text-sm/6 text-gray-900">
                    <span class="font-semibold">{{ $vehicle->metro->name }} Metro {{ $vehicle->number }}</span>
                </p>
                <p class="text-xs text-gray-400 line-clamp-1">{{ $vehicle->amenities->pluck('name')->implode(', ') }}</p>
            </div>
        </div>
        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
            @if(!in_array($vehicle->id, $booked_vehicles))
            <x-filament::button wire:click="addToCart({{ $vehicle->id }})">
                <span>Add to Cart</span>
            </x-filament::button>
            @endif
            @if(in_array($vehicle->id, $booked_vehicles))
            <x-filament::button color="danger" wire:click="removeFromCart({{ $vehicle->id }})">
                <span>Remove From Cart</span>
            </x-filament::button>
            @endif
            <p class="mt-1 text-xs/5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h ago</time></p>
        </div>
    </div>
    @endforeach
    @else
    <p>No Vehicles Found</p>
    @endif
</x-filament::section>