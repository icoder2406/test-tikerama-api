<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_category' => ['Autre', 'Concert-Spectacle', 'Diner Gala', 'Festival', 'Formation'][rand(0, 4)],
            'event_title' => $this->faker->name,
            'event_description' => $this->faker->text,
            'event_date' => $this->faker->date,
            'event_image' => $this->faker->url,
            'event_city' => $this->faker->city,
            'event_address' => $this->faker->address,
            'event_status' => ['upcoming', 'completed', 'cancelled'][rand(0, 2)],
            'event_created_on' => $this->faker->date,
        ];
    }
}
