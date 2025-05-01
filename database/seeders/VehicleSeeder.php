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
        $rows = collect(json_decode(file_get_contents(database_path('seeders/vehicles.json')), true));
        foreach ($rows as $row) {
            $array = $row;
            unset($array['amenities']);
            $vehicle = \App\Models\Vehicle::create($array);
            $vehicle->amenities()->attach($row['amenities']);
        }
    }
}
