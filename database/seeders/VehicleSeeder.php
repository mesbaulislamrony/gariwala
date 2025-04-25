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
    }
}
