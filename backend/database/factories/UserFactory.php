<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'username' => strtolower(implode('', explode(' ',$this->faker->unique()->name()))),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('1231234'), // password
            'avatar' => 'https://res.cloudinary.com/deundpsr2/image/upload/v1700135801/general/user/ameotogmx5u2fjhnv73r.jpg',
            'location' => 'Dhaka, Bangladesh',
            'bio' => 'A human being'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
