<?php

namespace App\Livewire\Filament\Pages\Order;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class CheckoutComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public ?array $invoice = [];

    public function mount(): void
    {
        $this->form->fill([
            'trip_date' => now(),
            'trip_type' => \App\Enums\TripTypeEnum::Oneway->value,
            'payment_method' => \App\Enums\PaymentMethodEnum::Cash->value,
        ]);
    }

    public function create()
    {
        $this->data = $this->form->getState();

        if (!Customer::where('email', $this->data['email'])->exists()) {
            Customer::create([
                'name' => $this->data['name'],
                'email' => $this->data['email'],
                'password' => \Illuminate\Support\Facades\Hash::make(12345678),
            ]);
        }
        $customer = Customer::where('email', $this->data['email'])->first();

        Booking::create([
            'customer_id' => $customer->id,
            'pickup_address' => $this->data['pickup_address'],
            'drop_address' => $this->data['drop_address'],
            'trip_date' => $this->data['trip_date'],
            'trip_time' => $this->data['trip_time'],
            'trip_type' => $this->data['trip_type'],
        ]);
        Order::where('email', auth()->user()->email)->delete();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            \Filament\Forms\Components\Section::make('Billing')->schema([
                \Filament\Forms\Components\Grid::make(3)->schema([
                    \Filament\Forms\Components\DatePicker::make('trip_date')
                        ->required()
                        ->native(false)
                        ->minDate(now()->format('Y-m-d'))
                        ->displayFormat('d F Y')
                        ->default(\Carbon\Carbon::now())
                        ->columnSpan(2),
                    \Filament\Forms\Components\TimePicker::make('trip_time')
                        ->required()
                        // ->minDate(now()->format('h:i A'))
                        ->seconds(false)
                        ->displayFormat('h:i A')
                        ->default(\Carbon\Carbon::now()),
                ]),
                \Filament\Forms\Components\TextInput::make('name')
                    ->required(),
                \Filament\Forms\Components\TextInput::make('email')
                    ->required(),
                \Filament\Forms\Components\Radio::make('trip_type')
                    ->inline()
                    ->inlineLabel(false)
                    ->options(collect(\App\Enums\TripTypeEnum::cases())->pluck('name', 'value')->toArray())
                    ->default(\App\Enums\TripTypeEnum::Oneway->value)
                    ->required(),
                \Filament\Forms\Components\Textarea::make('pickup_address')
                    ->required(),
                \Filament\Forms\Components\Textarea::make('drop_address')
                    ->required(),
                \Filament\Forms\Components\Radio::make('payment_method')
                    ->options(collect(\App\Enums\PaymentMethodEnum::cases())->pluck('name', 'value')->toArray())
                    ->default(\App\Enums\PaymentMethodEnum::Cash->value)
                    ->inline()
                    ->inlineLabel(false)
                    ->required(),
            ]),
        ])->statePath('data');
    }

    public function render()
    {
        return view('livewire.filament.pages.order.checkout-component');
    }
}
