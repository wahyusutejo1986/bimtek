<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    /**
     * Seed test users with known passwords for training scenarios.
     *
     * @return void
     */
    public function run()
    {
        // Create 5 test users with "password" as their password
        $testUsers = [
            [
                'first_name' => 'John',
                'last_name' => 'Smith',
                'email' => 'john.smith@organization.xyz',
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@organization.xyz',
            ],
            [
                'first_name' => 'Mike',
                'last_name' => 'Davis',
                'email' => 'mike.davis@organization.xyz',
            ],
            [
                'first_name' => 'Lisa',
                'last_name' => 'Wilson',
                'email' => 'lisa.wilson@organization.xyz',
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Brown',
                'email' => 'david.brown@organization.xyz',
            ]
        ];

        foreach ($testUsers as $userData) {
            User::create([
                'user_type' => 'user',
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'email' => $userData['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Hash the password for database storage
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]);
        }

        $this->command->info('✅ 5 test users created with password "password"');
        $this->command->info('Test users:');
        foreach ($testUsers as $user) {
            $this->command->info("   - {$user['email']} (password: password)");
        }
    }
}
