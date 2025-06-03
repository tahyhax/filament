<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Credit;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CreditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generator = Factory::create();

        $creditTypes = [
            'Basic Education Loan',
            'Standard Education Loan',
            'Premium Education Loan',
            'Student Loan',
            'MBA Loan',
            'Professional Development Loan',
            'Short-term Education Loan',
            'IT Education Loan',
            'Family Education Loan',
            'Language Course Loan',
        ];

        foreach ($creditTypes as $creditType) {
            Credit::create([
                'name' => $creditType,
                'description' => $generator->paragraph(),
                'amount' => $generator->numberBetween(5000, 100000),
                'term' => $generator->randomElement([6, 12, 24, 36, 48]),
                'interest_rate' => $generator->randomFloat(2, 4, 12),
                'is_active' => $generator->boolean(80),
            ]);
        }
    }
}
