@vite('resources/css/app.css')
<x-filament-panels::page>
    <div class="grid grid-cols-5 gap-4">
        <div class="col-span-2">
            @livewire('filament.pages.order.search-component')
        </div>
        <div class="col-span-3">
            @livewire('filament.pages.order.vehicles-component')
        </div>
    </div>
</x-filament-panels::page>