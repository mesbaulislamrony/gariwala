<x-filament::section>
    <x-slot name="heading">Invoice</x-slot>
    <x-slot name="headerEnd">
        <x-filament::button tag="a" href="{{ route('filament.employee.pages.checkout') }}">
            Download
        </x-filament::button>
    </x-slot>
    @if($order)
    @foreach($order['vehicles'] as $vehicle)
    <div class="flex justify-between gap-x-6">
        <div class="flex gap-x-3 items-center cursor-pointer mb-3">
            <img class="h-16 w-16 flex-none rounded-xl bg-gray-50" src="{{ asset($vehicle['image']) }}" alt="">
            <div class="min-w-0 flex-auto">
                <p class="text-sm font-semibold text-gray-900 truncate">{{ $vehicle['brand'] }} {{ $vehicle['model'] }} {{ $vehicle['type'] }}</p>
                <p class="text-sm/6 text-gray-900">
                    <span class="font-semibold">{{ $vehicle['number_plate'] }}</span>
                </p>
                <p class="text-xs text-gray-400 line-clamp-1">{{ $vehicle['amenities'] }}</p>
            </div>
        </div>
        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
            <x-filament::button color="danger" wire:click="removeFromCart({{ $vehicle['id'] }})">
                <span>Remove</span>
            </x-filament::button>
            <p class="mt-1 text-xs/5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h ago</time></p>
        </div>
    </div>
    @endforeach
    @endif
</x-filament::section>