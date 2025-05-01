<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'customer_id',
        'pickup_address',
        'drop_address',
        'trip_date',
        'trip_time',
        'trip_type',
        'payment_method'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
