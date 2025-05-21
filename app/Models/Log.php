<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    public $timestamps = false; // car nous utilisons seulement created_at ici

    protected $fillable = [
        'user_id',
        'action',
        'description'
    ];

    // Un log est généré par un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper methods
    public static function activity($userId, $action, $description)
    {
        return self::create([
            'user_id' => $userId,
            'action' => $action,
            'description' => $description
        ]);
    }
}
