<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ExpenseCategory::create([
            'name' => 'Food',
            'slug' => 'food',
        ]);

        \App\Models\ExpenseCategory::create([
            'name' => 'Transport',
            'slug' => 'transport',
        ]);

        \App\Models\ExpenseCategory::create([
            'name' => 'Entertainment',
            'slug' => 'entertainment',
        ]);

        \App\Models\ExpenseCategory::create([
            'name' => 'Other',
            'slug' => 'other',
        ]);
    }
}
