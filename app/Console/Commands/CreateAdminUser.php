<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create {email?} {name?} {password?}';

    protected $description = 'Create a new admin user';

    public function handle(): int
    {
        $email = $this->argument('email') ?? $this->ask('What is the admin email?');
        $name = $this->argument('name') ?? $this->ask('What is the admin name?');
        $password = $this->argument('password') ?? $this->secret('What is the admin password?');

        try {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]);

            // Assign super_admin role
            $user->assignRole('super_admin');

            $this->info('Admin user created successfully!');
            $this->table(
                ['Name', 'Email'],
                [[$user->name, $user->email]]
            );

            return self::SUCCESS;
        } catch (Exception $exception) {
            $this->error('Error creating admin user: ' . $exception->getMessage());
            return self::FAILURE;
        }
    }
}
