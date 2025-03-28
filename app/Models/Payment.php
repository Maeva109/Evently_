<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
     // Un paiement est réalisé par un utilisateur
     public function user()
     {
         return $this->belongsTo(User::class);
     }
 
     // Un paiement est lié à un événement
     public function event()
     {
         return $this->belongsTo(Event::class);
     }
 
     // Optionnel : le validateur du paiement (admin ou modérateur)
     public function validator()
     {
         return $this->belongsTo(User::class, 'validated_by');
     }
}
