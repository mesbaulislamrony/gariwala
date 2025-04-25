
<x-filament-panels::page>
    @livewire('filament.pages.order.search-component')
    <div class="flex flex-col gap-4">
        @livewire('filament.pages.order.filter-component')
        @livewire('filament.pages.order.vehicles-component')
    </div>
</x-filament-panels::page>
