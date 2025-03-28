<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\Payment;
use App\Models\Review;
use App\Models\Notification;
use App\Models\Log;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Créer 10 utilisateurs
    User::factory(10)->create();

    // Création de 5 catégories
    Category::factory(5)->create();

    //Création de 20 événements
    Event::factory(20)->create();

    // création de 30 réservations
    Reservation::factory(30)->create();

    // Création de 30 paiements
    Payment::factory(30)->create();

    // Création de 20 avis
    Review::factory(20)->create();

    // Création de 20 notifications
    Notification::factory(20)->create();

    // Création de 50 logs
    Log::factory(50)->create();
    }
}
