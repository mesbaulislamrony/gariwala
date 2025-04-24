<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function metro()
    {
        return $this->belongsTo(Metro::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_vehicle');
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_vehicle');
    }

    public function fuelLogs()
    {
        return $this->hasMany(FuelLog::class);
    }
}
