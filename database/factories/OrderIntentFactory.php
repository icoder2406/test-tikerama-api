<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderIntent>
 */
class OrderIntentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_intent_price' => $this->faker->numberBetween(100, 1000),
            'order_intent_type' => $this->faker->name,
            'user_email' => $this->faker->email,
            'user_phone' => $this->faker->phoneNumber,
            'expiration_date' => $this->faker->date,
        ];
    }
}
