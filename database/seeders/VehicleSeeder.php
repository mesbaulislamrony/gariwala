<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicle = \App\Models\Vehicle::create([
            'name' => 'Toyota Camry',
            'slug' => 'toyota-camry',
            'number' => 'LA-1234',
            'type_id' => 1,
            'brand_id' => 1,
            'metro_id' => 1,
            'description' => 'A comfortable and reliable car',
            'status' => 'running',
        ]);
        $vehicle->amenities()->attach([2, 7, 5, 8, 6]);
        $vehicle->users()->attach([1, 2]);
        $vehicle->customers()->attach([1]);
        $vehicle->fuelLogs()->create([
            'fuel_type' => 'petrol',
            'date' => Carbon::now(),
            'odometer' => 34567,
            'price' => 150,
            'qty' => 10,
            'total' => 1500
        ]);

        $vehicle = \App\Models\Vehicle::create([
            'name' => 'Honda Accord',
            'slug' => 'honda-accord',
            'number' => 'GA-5678',
            'type_id' => 2,
            'brand_id' => 2,
            'metro_id' => 2,
            'description' => 'A comfortable and reliable car',
            'status' => 'running',
        ]);
        $vehicle->amenities()->attach([3, 4, 2, 7, 9]);
        $vehicle->users()->attach([1, 2, 3]);
        $vehicle->fuelLogs()->create([
            'fuel_type' => 'cng',
            'date' => Carbon::now(),
            'odometer' => 4567,
            'price' => 200,
            'qty' => 10,
            'total' => 2000
        ]);
    }
}
