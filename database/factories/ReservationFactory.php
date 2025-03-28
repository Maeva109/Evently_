<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
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
            'user_id' => User::factory()->create(),
            'event_id' => Event::factory()->create(),
            'reservation_type' => $this->faker->randomElement(['standard', 'VIP', 'early_bird']),
            'status' => $this->faker->randomElement(['confirmed', 'pending', 'canceled']),
            'qr_code' => strtoupper(Str::random(10)),
        ];
    }
}
