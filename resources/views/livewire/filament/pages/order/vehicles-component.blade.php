<div>
    @if($vehicles)
    @foreach($vehicles as $vehicle)
    <div class="bg-white px-3 py-3 rounded-xl shadow-md ring-1 ring-gray-950/5 mb-3">
        <div class="flex gap-x-3 items-center cursor-pointer">
            <div class="min-w-0 flex-auto">
                <p class="text-sm font-semibold text-gray-900 truncate">{{ $vehicle->name }}</p>
                <p class="text-sm/6 text-gray-900">
                    <span class="font-semibold">{{ $vehicle->metro->name }} Metro {{ $vehicle->number }}</span>
                </p>
                <p class="text-xs text-gray-400 line-clamp-1">{{ $vehicle->amenities->pluck('name')->implode(', ') }}</p>
            </div>
            <img class="h-16 w-16 flex-none rounded-xl bg-gray-50" src="{{ asset($vehicle->image) }}" alt="">
        </div>
    </div>
    @endforeach
    @endif
</div>