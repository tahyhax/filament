<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Credit;
use App\Models\Specialty;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generator = Factory::create();

        $courses = [
            [
                'name' => 'Python Programming Fundamentals',
                'code' => 'PY101',
            ],
            [
                'name' => 'JavaScript Essentials',
                'code' => 'JS101',
            ],
            [
                'name' => 'Advanced React Development',
                'code' => 'RE201',
            ],
            [
                'name' => 'Enterprise Java Development',
                'code' => 'JV301',
            ],
            [
                'name' => 'DevOps Practices and Tools',
                'code' => 'DO201',
            ],
            [
                'name' => 'SQL Fundamentals',
                'code' => 'SQL101',
            ],
            [
                'name' => 'Machine Learning with Python',
                'code' => 'ML201',
            ],
            [
                'name' => 'Cybersecurity Fundamentals',
                'code' => 'SEC201',
            ],
            [
                'name' => 'Flutter Mobile Development',
                'code' => 'FL201',
            ],
            [
                'name' => 'Software Architecture',
                'code' => 'AR301',
            ],
        ];

        foreach ($courses as $course) {
            $newCourse = Course::create([
                'name' => $course['name'],
                'code' => $course['code'],
                'description' => $generator->paragraph(),
                'duration' => $generator->numberBetween(20, 80),
                'price' => $generator->numberBetween(10000, 50000),
                'is_active' => $generator->boolean(80),
            ]);

            // Attach random credits and specialties
            $credits = Credit::inRandomOrder()->limit($generator->numberBetween(1, 3))->get();
            $specialties = Specialty::inRandomOrder()->limit($generator->numberBetween(1, 3))->get();

            foreach ($credits as $credit) {
                $newCourse->credits()->attach($credit->id);
            }

            foreach ($specialties as $specialty) {
                $newCourse->specialties()->attach($specialty->id);
            }
        }
    }
}
