<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => $this->faker->numberBetween(),
            'order_event_id' => $this->faker->numberBetween(1, Event::count()),
            'order_price' => $this->faker->numberBetween(100, 1000),
            'order_type' => $this->faker->name,
            'order_payment' => ['Tmoney', 'Flooz', 'Card', 'Bank'][rand(0, 3)],
            'order_info' => $this->faker->text(70),
            'order_created_on' => $this->faker->date,
            'order_client_id' => $this->faker->numberBetween(100, 777),
        ];
    }
}
