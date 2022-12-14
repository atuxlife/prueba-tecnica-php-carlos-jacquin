<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $hash = Hash::make('password', [
            'memory'    => 1024,
            'time'      => 2,
            'threads'   => 2,
        ]);

        return [
            'role'              => $this->faker->randomElement(['A','U']),
            'firstname'         => $this->faker->name(),
            'lastname'          => $this->faker->lastName(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => Carbon::now(),
            'password'          => $hash, // password
            'remember_token'    => Str::random(10),
            'status'            =>  1,
            'user_create_id'    =>  1,
            'ip_create'         =>  '127.0.0.1',
            'created_at'        =>  Carbon::now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
