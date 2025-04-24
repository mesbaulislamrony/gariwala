<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Brand::create([
            'name' => 'Toyota',
            'slug' => 'toyota',
        ]);

        \App\Models\Brand::create([
            'name' => 'Honda',
            'slug' => 'honda',
        ]); 

        \App\Models\Brand::create([
            'name' => 'Suzuki',
            'slug' => 'suzuki',
        ]); 

        \App\Models\Brand::create([
            'name' => 'Mazda',
            'slug' => 'mazda',
        ]); 

        \App\Models\Brand::create([
            'name' => 'Audi',
            'slug' => 'audi',
        ]); 

        \App\Models\Brand::create([
            'name' => 'Nissan',
            'slug' => 'nissan',
        ]); 

        \App\Models\Brand::create([
            'name' => 'Mercedes Benz',
            'slug' => 'mercedes-benz',
        ]); 
    }
}
