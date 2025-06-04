<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Credit;
use Illuminate\Database\Seeder;

class CreditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $credits = [
            [
                'name' => 'Academic Writing',
                'description' => 'Develop academic writing skills',
                'amount' => 5000,
                'term' => 12,
                'interest_rate' => 5.5,
                'is_active' => true,
            ],
            [
                'name' => 'Research Methods',
                'description' => 'Learn research methodologies',
                'amount' => 7500,
                'term' => 24,
                'interest_rate' => 6.0,
                'is_active' => true,
            ],
            [
                'name' => 'Critical Thinking',
                'description' => 'Enhance analytical and critical thinking',
                'amount' => 6000,
                'term' => 18,
                'interest_rate' => 5.8,
                'is_active' => true,
            ],
            [
                'name' => 'Digital Literacy',
                'description' => 'Master digital tools and technologies',
                'amount' => 4500,
                'term' => 12,
                'interest_rate' => 5.2,
                'is_active' => true,
            ],
            [
                'name' => 'Professional Ethics',
                'description' => 'Understanding professional conduct and ethics',
                'amount' => 5500,
                'term' => 15,
                'interest_rate' => 5.7,
                'is_active' => true,
            ],
            [
                'name' => 'Communication Skills',
                'description' => 'Improve verbal and written communication',
                'amount' => 4800,
                'term' => 12,
                'interest_rate' => 5.3,
                'is_active' => true,
            ],
            [
                'name' => 'Project Management',
                'description' => 'Learn project planning and execution',
                'amount' => 8000,
                'term' => 24,
                'interest_rate' => 6.2,
                'is_active' => true,
            ],
            [
                'name' => 'Leadership',
                'description' => 'Develop leadership capabilities',
                'amount' => 7000,
                'term' => 18,
                'interest_rate' => 5.9,
                'is_active' => true,
            ],
            [
                'name' => 'Innovation',
                'description' => 'Foster creative thinking and innovation',
                'amount' => 6500,
                'term' => 15,
                'interest_rate' => 5.6,
                'is_active' => true,
            ],
            [
                'name' => 'Global Perspective',
                'description' => 'Understanding international contexts',
                'amount' => 7200,
                'term' => 18,
                'interest_rate' => 5.8,
                'is_active' => true,
            ],
        ];

        foreach ($credits as $credit) {
            Credit::create($credit);
        }
    }
}
