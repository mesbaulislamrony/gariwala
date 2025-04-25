@vite('resources/css/app.css')
<x-filament-panels::page>
    <div class="grid grid-cols-2 gap-2">
        <x-filament::section>
            <x-slot name="heading">Filters</x-slot>
            @livewire('filament.pages.order.search-component')
            @livewire('filament.pages.order.filter-component')
        </x-filament::section>
        @livewire('filament.pages.order.vehicles-component')
    </div>
</x-filament-panels::page>