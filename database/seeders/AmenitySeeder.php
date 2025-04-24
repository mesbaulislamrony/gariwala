<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Amenity::create([
            'name' => 'Air Conditioner',
            'slug' => 'air-conditioner',
        ]);

        \App\Models\Amenity::create([
            'name' => 'Music System',
            'slug' => 'music-system',
        ]);

        \App\Models\Amenity::create([
            'name' => 'Wi-Fi',
            'slug' => 'wi-fi',
        ]);

        \App\Models\Amenity::create([
            'name' => 'GPS Navigation',
            'slug' => 'gps-navigation',
        ]);

        \App\Models\Amenity::create([
            'name' => 'Charging Port',
            'slug' => 'charging-port',
        ]);

        \App\Models\Amenity::create([
            'name' => 'Luggage Space',
            'slug' => 'luggage-space',
        ]);

        \App\Models\Amenity::create([
            'name' => 'Child Seat',
            'slug' => 'child-seat',
        ]);

        \App\Models\Amenity::create([
            'name' => 'Tinted Windows',
            'slug' => 'tinted-windows',
        ]);

        \App\Models\Amenity::create([
            'name' => 'Reverse Camera',
            'slug' => 'reverse-camera',
        ]);

        \App\Models\Amenity::create([
            'name' => 'Wheelchair Access',
            'slug' => 'wheelchair-access',
        ]);
    }
}