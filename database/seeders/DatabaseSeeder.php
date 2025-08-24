<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
       $this->call([
            AdminUserSeeder::class,
        ]);
        User::factory()->create([
            'email' => 'admin@myspc.edu'],
            [
                'fullname'         => 'System Administrator',
                'password'         => Hash::make('12345678'), // change in production!
                'role'             => 'admin',
                'course'           => 'N/A',
                'year_level'       => 'N/A',
                'college'          => 'N/A',
                'gender'           => 'N/A',
                'submission_count' => 0,
                'email_verified_at'=> now(),
        ]);
    }
}
