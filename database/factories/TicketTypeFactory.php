<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketType>
 */
class TicketTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_type_event_id' => $this->faker->numberBetween(1, Event::count()),
            'ticket_type_name' => $this->faker->name,
            'ticket_type_price' => $this->faker->numberBetween(100, 2000),
            'ticket_type_quantity' => $this->faker->numberBetween(1, 12),
            'ticket_type_real_quantity' => $this->faker->numberBetween(1, 11),
            'ticket_type_total_quantity' => $this->faker->numberBetween(1, 11),
            'ticket_type_description' => $this->faker->text,
        ];
    }
}
