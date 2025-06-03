<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Specialty;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generator = Factory::create();

        $specialties = [
            ['name' => 'Software Development', 'code' => 'SD001'],
            ['name' => 'Web Development', 'code' => 'WD001'],
            ['name' => 'Mobile Development', 'code' => 'MD001'],
            ['name' => 'Artificial Intelligence', 'code' => 'AI001'],
            ['name' => 'Cybersecurity', 'code' => 'CS001'],
            ['name' => 'Data Analysis', 'code' => 'DA001'],
            ['name' => 'Cloud Computing', 'code' => 'CC001'],
            ['name' => 'DevOps Engineering', 'code' => 'DE001'],
            ['name' => 'UX/UI Design', 'code' => 'UD001'],
            ['name' => 'Software Testing', 'code' => 'ST001'],
            ['name' => 'Blockchain Development', 'code' => 'BD001'],
            ['name' => 'System Administration', 'code' => 'SA001'],
            ['name' => 'Computer Graphics', 'code' => 'CG001'],
            ['name' => 'Embedded Systems', 'code' => 'ES001'],
            ['name' => 'Project Management', 'code' => 'PM001'],
            ['name' => 'Business Analysis', 'code' => 'BA001'],
            ['name' => 'Machine Learning', 'code' => 'ML001'],
            ['name' => 'Game Development', 'code' => 'GD001'],
            ['name' => 'Network Engineering', 'code' => 'NE001'],
            ['name' => 'Technical Writing', 'code' => 'TW001'],
        ];

        foreach ($specialties as $specialty) {
            Specialty::create([
                'name' => $specialty['name'],
                'code' => $specialty['code'],
                'description' => $generator->paragraph(),
                'is_active' => $generator->boolean(80),
            ]);
        }
    }
}
