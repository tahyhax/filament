<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            [
                'name' => 'Computer Science',
                'code' => 'CS001',
                'description' => 'Study of computation, automation, and information',
                'is_active' => true,
            ],
            [
                'name' => 'Data Science',
                'code' => 'DS001',
                'description' => 'Analysis of data and machine learning',
                'is_active' => true,
            ],
            [
                'name' => 'Software Engineering',
                'code' => 'SE001',
                'description' => 'Software development and engineering principles',
                'is_active' => true,
            ],
            [
                'name' => 'Artificial Intelligence',
                'code' => 'AI001',
                'description' => 'Study of intelligent systems and algorithms',
                'is_active' => true,
            ],
            [
                'name' => 'Cybersecurity',
                'code' => 'CS002',
                'description' => 'Information security and cyber defense',
                'is_active' => true,
            ],
            [
                'name' => 'Web Development',
                'code' => 'WD001',
                'description' => 'Web applications and technologies',
                'is_active' => true,
            ],
            [
                'name' => 'Mobile Development',
                'code' => 'MD001',
                'description' => 'Mobile app development for various platforms',
                'is_active' => true,
            ],
            [
                'name' => 'Cloud Computing',
                'code' => 'CC001',
                'description' => 'Cloud infrastructure and services',
                'is_active' => true,
            ],
            [
                'name' => 'Network Engineering',
                'code' => 'NE001',
                'description' => 'Computer networks and telecommunications',
                'is_active' => true,
            ],
            [
                'name' => 'DevOps Engineering',
                'code' => 'DO001',
                'description' => 'Development operations and automation',
                'is_active' => true,
            ],
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
