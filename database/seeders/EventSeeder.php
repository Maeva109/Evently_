<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run()
    {
        Event::create([
            'title' => 'Test Event',
            'description' => 'This is a test event.',
            'start_date' => now(),
            'end_date' => now()->addDays(1),
            'is_published' => false,
            'is_active' => true,
        ]);
    }
}