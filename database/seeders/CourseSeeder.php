<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Credit;
use App\Models\Specialty;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'name' => 'Introduction to Programming',
                'code' => 'CSE101',
                'description' => 'Basic concepts of programming and algorithms',
                'duration' => 12,
                'price' => 299.99,
                'is_active' => true,
            ],
            [
                'name' => 'Web Development Fundamentals',
                'code' => 'WEB201',
                'description' => 'HTML, CSS, and JavaScript basics',
                'duration' => 16,
                'price' => 349.99,
                'is_active' => true,
            ],
            [
                'name' => 'Database Management',
                'code' => 'DBS301',
                'description' => 'SQL and database design principles',
                'duration' => 14,
                'price' => 399.99,
                'is_active' => true,
            ],
            [
                'name' => 'Advanced Programming',
                'code' => 'CSE201',
                'description' => 'Object-oriented programming and design patterns',
                'duration' => 20,
                'price' => 449.99,
                'is_active' => true,
            ],
            [
                'name' => 'Mobile App Development',
                'code' => 'MOB301',
                'description' => 'Creating applications for mobile platforms',
                'duration' => 18,
                'price' => 499.99,
                'is_active' => true,
            ],
            [
                'name' => 'Cloud Computing Essentials',
                'code' => 'CLD101',
                'description' => 'Introduction to cloud services and deployment',
                'duration' => 15,
                'price' => 399.99,
                'is_active' => true,
            ],
            [
                'name' => 'Artificial Intelligence Basics',
                'code' => 'AI101',
                'description' => 'Fundamentals of AI and machine learning',
                'duration' => 16,
                'price' => 549.99,
                'is_active' => true,
            ],
            [
                'name' => 'Network Security',
                'code' => 'SEC201',
                'description' => 'Network security principles and practices',
                'duration' => 14,
                'price' => 449.99,
                'is_active' => true,
            ],
            [
                'name' => 'DevOps Practices',
                'code' => 'DEV301',
                'description' => 'Continuous integration and deployment',
                'duration' => 12,
                'price' => 399.99,
                'is_active' => true,
            ],
            [
                'name' => 'Data Science Fundamentals',
                'code' => 'DAT101',
                'description' => 'Introduction to data analysis and visualization',
                'duration' => 16,
                'price' => 499.99,
                'is_active' => true,
            ],
            [
                'name' => 'Software Testing',
                'code' => 'TST201',
                'description' => 'Testing methodologies and automation',
                'duration' => 12,
                'price' => 349.99,
                'is_active' => true,
            ],
            [
                'name' => 'UI/UX Design',
                'code' => 'DES101',
                'description' => 'User interface and experience design',
                'duration' => 14,
                'price' => 399.99,
                'is_active' => true,
            ],
            [
                'name' => 'Blockchain Technology',
                'code' => 'BLK201',
                'description' => 'Fundamentals of blockchain and cryptocurrencies',
                'duration' => 15,
                'price' => 549.99,
                'is_active' => true,
            ],
            [
                'name' => 'System Architecture',
                'code' => 'ARC301',
                'description' => 'Design and implementation of system architecture',
                'duration' => 18,
                'price' => 499.99,
                'is_active' => true,
            ],
            [
                'name' => 'Project Management',
                'code' => 'PMG201',
                'description' => 'Managing software development projects',
                'duration' => 12,
                'price' => 399.99,
                'is_active' => true,
            ],
            [
                'name' => 'Machine Learning',
                'code' => 'ML301',
                'description' => 'Advanced machine learning algorithms',
                'duration' => 20,
                'price' => 599.99,
                'is_active' => true,
            ],
            [
                'name' => 'Cybersecurity Fundamentals',
                'code' => 'SEC101',
                'description' => 'Basic concepts of cybersecurity',
                'duration' => 14,
                'price' => 449.99,
                'is_active' => true,
            ],
            [
                'name' => 'Full Stack Development',
                'code' => 'FSD301',
                'description' => 'End-to-end web application development',
                'duration' => 24,
                'price' => 699.99,
                'is_active' => true,
            ],
            [
                'name' => 'Cloud Architecture',
                'code' => 'CLD301',
                'description' => 'Designing cloud-based solutions',
                'duration' => 16,
                'price' => 549.99,
                'is_active' => true,
            ],
            [
                'name' => 'Big Data Analytics',
                'code' => 'BDA201',
                'description' => 'Processing and analyzing large datasets',
                'duration' => 18,
                'price' => 599.99,
                'is_active' => true,
            ],
        ];

        $credits = Credit::all();
        $specialties = Specialty::all();

        foreach ($courses as $courseData) {
            $course = Course::create($courseData);

            // Attach 2-4 random credits to each course
            $course->credits()->attach(
                $credits->random(random_int(2, 4))->pluck('id')->toArray()
            );

            // Attach 1-3 random specialties to each course
            $course->specialties()->attach(
                $specialties->random(random_int(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
