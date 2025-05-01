<?php

namespace App\Livewire\Filament\Pages\Order;

use App\Models\Order;
use Livewire\Component;

class InvoiceComponent extends Component
{
    public $order;

    public function mount()
    {
        $this->order();
    }

    public function render()
    {
        return view('livewire.filament.pages.order.invoice-component');
    }

    public function order()
    {
        $order = Order::where('email', auth()->user()->email)->first();
        if ($order) {
            $this->order = collect(json_decode($order->trip, true))->toArray();
        }
    }
}
