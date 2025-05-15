<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    public function run()
    {
        $events = Event::all();

        foreach ($events as $event) {
            // VIP Ticket
            TicketType::create([
                'event_id' => $event->id,
                'name' => 'VIP',
                'description' => 'Access to VIP area, complimentary drinks, and meet & greet',
                'price' => 150.00,
                'capacity' => 50,
                'is_available' => true
            ]);

            // Standard Ticket
            TicketType::create([
                'event_id' => $event->id,
                'name' => 'Standard',
                'description' => 'General admission with standard seating',
                'price' => 75.00,
                'capacity' => 200,
                'is_available' => true
            ]);

            // Early Bird Ticket
            TicketType::create([
                'event_id' => $event->id,
                'name' => 'Early Bird',
                'description' => 'Limited early bird tickets at a special price',
                'price' => 50.00,
                'capacity' => 100,
                'is_available' => true
            ]);
        }
    }
} 