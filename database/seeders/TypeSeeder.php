<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Type::create([
            'name' => 'Coupe',
            'slug' => 'coupe',
        ]);

        \App\Models\Type::create([
            'name' => 'Hatchback',
            'slug' => 'hatchback',
        ]);

        \App\Models\Type::create([
            'name' => 'Sedan',
            'slug' => 'sedan',
        ]);
    }
}
