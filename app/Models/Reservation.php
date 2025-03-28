<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
     // Une réservation appartient à un utilisateur
     public function user()
     {
         return $this->belongsTo(User::class);
     }
 
     // Une réservation concerne un événement
     public function event()
     {
         return $this->belongsTo(Event::class);
     }
}
