<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Order;
use App\Models\TicketType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_event_id' => $this->faker->numberBetween(1, Event::count()),
            'ticket_email' => $this->faker->email,
            'ticket_phone' => $this->faker->phoneNumber,
            'ticket_price' => $this->faker->numberBetween(100, 3000),
            'ticket_order_id' => $this->faker->numberBetween(1, Order::count()),
            'ticket_key' => Str::upper(Str::random(14)),
            'ticket_ticket_type_id' => $this->faker->numberBetween(1, TicketType::count()),
            'ticket_status' => ['active', 'validated', 'expired', 'cancelled'][rand(0, 3)],
            'ticket_created_on' => $this->faker->date,
        ];
    }
}
