<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelLog extends Model
{
    protected $fillable = [
        'vehicle_id',
        'fuel_type',
        'date',
        'odometer',
        'price',
        'qty',
        'total',
        'note',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
