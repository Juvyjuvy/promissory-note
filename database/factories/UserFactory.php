<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /** @var class-string<\App\Models\User> */
    protected $model = User::class;

    /**
     * Define the model's default state (generic student user).
     */
    public function definition(): array
    {
        return [
            'fullname'          => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'password'          => Hash::make('password'), // change in prod
            'role'              => 'student',
            'course'            => null,
            'year_level'        => null,
            'college'           => null,
            'gender'            => null,
            'submission_count'  => 0,
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Admin state: creates a fixed admin account.
     */
    public function admin(): static
    {
        return $this->state(fn () => [
            'fullname'   => 'System Administrator',
            'email'      => 'admin@myspc.edu',
            'password'   => Hash::make('12345678'), // change in prod!
            'role'       => 'admin',
            'course'     => 'N/A',
            'year_level' => 'N/A',
            'college'    => 'N/A',
            'gender'     => 'N/A',
        ]);
    }
}
