<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    public $timestamps = false; // car nous utilisons seulement created_at ici

    // Un log est généré par un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
