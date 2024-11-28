<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => User::factory(),
            'name' => $this->faker->word,
            'price' => $this->faker->randomNumber(2),
            'status' => $this->faker->boolean()
        ];
    }
}
