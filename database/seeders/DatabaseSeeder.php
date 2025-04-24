<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Mesbaul Islam',
            'email' => 'mesbaul@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make(12345678),
        ]);

        \App\Models\Customer::factory()->create([
            'name' => 'Jahidul Islam',
            'email' => 'jahidul@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make(12345678),
        ]);
    }
}
