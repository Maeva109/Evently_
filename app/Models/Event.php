<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Un événement est créé par un utilisateur (organisateur)
    public function organizer()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Un événement peut avoir plusieurs réservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Un événement peut avoir plusieurs paiements
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Un événement peut recevoir plusieurs avis
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
