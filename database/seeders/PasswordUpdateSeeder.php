<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PasswordUpdateSeeder extends Seeder
{
    /**
     * Update all users with new passwords and save plaintext passwords to file.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $passwordFile = [];
        $passwordFile[] = "=== ENTERPRISE USER PASSWORD BACKUP ===";
        $passwordFile[] = "Generated: " . date('Y-m-d H:i:s');
        $passwordFile[] = "System: Organization.xyz Enterprise Management Platform";
        $passwordFile[] = "Purpose: User credential backup before system migration";
        $passwordFile[] = str_repeat("=", 60);
        $passwordFile[] = "";

        foreach ($users as $index => $user) {
            // Generate new realistic password for each user
            $newPassword = $this->generateNewPassword($user, $index);
            
            // Save to plaintext file (this is what infostealer would steal)
            $passwordFile[] = sprintf(
                "User: %-25s | Email: %-35s | Password: %s",
                $user->first_name . ' ' . $user->last_name,
                $user->email,
                $newPassword
            );
            
            // Update user in database with hashed password
            $user->update([
                'password' => Hash::make($newPassword)
            ]);
        }

        $passwordFile[] = "";
        $passwordFile[] = "=== END OF PASSWORD BACKUP ===";
        $passwordFile[] = "Total Users: " . $users->count();
        $passwordFile[] = "WARNING: This file contains plaintext passwords - SECURE STORAGE REQUIRED";

        // Save to storage (this simulates the file that gets stolen)
        $content = implode("\n", $passwordFile);
        Storage::disk('local')->put('user_passwords_backup.txt', $content);
        
        // Also save to public directory for easy access during training
        file_put_contents(public_path('user_passwords_backup.txt'), $content);

        $this->command->info('✅ All user passwords updated and backup file created');
        $this->command->info('📁 Password file saved to: public/user_passwords_backup.txt');
        $this->command->info('⚠️  File contains ' . $users->count() . ' plaintext passwords');
    }

    /**
     * Generate new realistic passwords for users
     */
    private function generateNewPassword($user, $index)
    {
        // Keep our test users with simple "password" 
        $testUserEmails = [
            'john.smith@organization.xyz',
            'sarah.johnson@organization.xyz', 
            'mike.davis@organization.xyz',
            'lisa.wilson@organization.xyz',
            'david.brown@organization.xyz'
        ];
        
        if (in_array($user->email, $testUserEmails)) {
            return 'password';
        }

        // Generate varied passwords based on common patterns
        $passwordPatterns = [
            // Weak passwords (30%)
            ['password123', 'admin123', 'letmein', 'welcome123', 'qwerty123', '123456789', 'password1'],
            
            // Personal passwords (25%)
            [
                strtolower($user->first_name) . '2024',
                strtolower($user->last_name) . '123',
                strtolower($user->first_name) . strtolower($user->last_name),
                ucfirst(strtolower($user->first_name)) . '2024!'
            ],
            
            // Corporate passwords (25%)
            ['Company2024!', 'Office123!', 'Business2024', 'Work2024!', 'Enterprise123', 'Corporate2024'],
            
            // Strong passwords (20%)
            ['MyS3cur3P@ss!', 'Str0ng!P@ssw0rd', 'C0mplex!2024', 'S3cur3!Ent3rpr1se', 'Adm1n!Str@t0r']
        ];

        // Determine pattern category based on index
        $category = $index % 4;
        $patterns = $passwordPatterns[$category];
        
        return $patterns[array_rand($patterns)];
    }
}
