@vite('resources/css/app.css')
<x-filament-panels::page>
    <div class="grid grid-cols-5 gap-4">
        <div class="col-span-2">
            @livewire('filament.pages.order.checkout-component')
        </div>
        <div class="col-span-3">
            @livewire('filament.pages.order.invoice-component')
        </div>
    </div>
</x-filament-panels::page>