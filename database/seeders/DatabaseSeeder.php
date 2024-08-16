<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Order;
use App\Models\OrderIntent;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Event::factory(100)->create();
        Order::factory(100)->create();
        OrderIntent::factory(100)->create();
        TicketType::factory(100)->create();
        Ticket::factory(100)->create();
    }
}
