<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
            'name' => 'Mesbaul Islam',
            'email' => 'mesbaul@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make(12345678),
            'role' => 'employee',
        ]);

        $user->account()->create([
            'balance' => 100000
        ]);

        $user = \App\Models\User::create([
            'name' => 'Faridul Islam',
            'email' => 'faridul@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make(12345678),
            'role' => 'driver',
        ]);

        $user->account()->create([
            'balance' => 0
        ]);

        $user->payroll()->create([
            'basic_salary' => 10000,
            'allowance' => 500,
            'net_salary' => 10500,
            'commission_rate' => 10,
            'joining_date' => \Carbon\Carbon::now()->subDays(10),
        ]);

        $user = \App\Models\User::create([
            'name' => 'Jakaria Islam',
            'email' => 'jakaria@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make(12345678),
            'role' => 'partner',
        ]);

        $user->account()->create([
            'balance' => 0
        ]);

        $user->payroll()->create([
            'commission_rate' => 10,
            'joining_date' => \Carbon\Carbon::now()->subDays(10),
        ]);

        \App\Models\Customer::create([
            'name' => 'Jahidul Islam',
            'email' => 'jahidul@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make(12345678),
        ]);
    }
}
