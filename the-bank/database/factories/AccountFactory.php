<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'balance' => fake()->numberBetween(0, 10000000),
            'interest_rate' => fake()->randomFloat(2, 0, 1),
            'interest_overflow' => fake()->randomFloat(8, 0, 1),
        ];
    }
}
