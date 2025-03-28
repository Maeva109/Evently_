<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
            //
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph,
            'start_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'location' => $this->faker->address,
            'event_type' => $this->faker->randomElement(['presentiel', 'online']),
            'payment_type' => $this->faker->randomElement(['free', 'paid']),
            'category_id' => Category::factory()->create(),
            'created_by' => User::factory()->state(['role' => 'organizer']),
            'status' => $this->faker->randomElement(['draft', 'published', 'deactivated']),
            
        ];
    }
}
