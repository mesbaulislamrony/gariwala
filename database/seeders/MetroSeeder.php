<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Metro::create([
            'name' => 'Dhaka',
            'slug' => 'dhaka',
        ]);

        \App\Models\Metro::create([
            'name' => 'Chittagong',
            'slug' => 'chittagong',
        ]);

        \App\Models\Metro::create([
            'name' => 'Khulna',
            'slug' => 'khulna',
        ]);

        \App\Models\Metro::create([
            'name' => 'Sylhet',
            'slug' => 'sylhet',
        ]);

        \App\Models\Metro::create([
            'name' => 'Rangpur',
            'slug' => 'rangpur',
        ]);

        \App\Models\Metro::create([
            'name' => 'Rajshahi',
            'slug' => 'rajshahi',
        ]);
    }
}
