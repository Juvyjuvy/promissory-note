<?php
// database/seeders/AdminUserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // create only if not exists
        User::firstOrCreate(
            ['email' => 'admin@mysc.edu'],
            [
                'fullname'         => 'System Administrator',
                'password'         => Hash::make('Admin@12345'), // change in production!
                'role'             => 'admin',
                'course'           => 'N/A',
                'year_level'       => 'N/A',
                'college'          => 'N/A',
                'gender'           => 'N/A',
                'submission_count' => 0,
                'email_verified_at'=> now(),
            ]
        );
    }
}
