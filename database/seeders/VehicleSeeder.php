<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Vehicle::create([
            'name' => 'Toyota Camry',
            'slug' => 'toyota-camry',
            'number' => '12345678',
            'type_id' => 1,
            'brand_id' => 1,
            'metro_id' => 1,
            'description' => 'A comfortable and reliable car',
            'price_per_hour' => 100.00,
            'status' => 'running',
        ]);

        \App\Models\Vehicle::create([
            'name' => 'Honda Accord',
            'slug' => 'honda-accord',
            'number' => '12345678',
            'type_id' => 1,
            'brand_id' => 2,
            'metro_id' => 1,
            'description' => 'A comfortable and reliable car',
            'price_per_hour' => 100.00,
            'status' => 'running',
        ]);
    }
}
