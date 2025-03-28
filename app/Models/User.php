<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function events()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    // Relation : Un utilisateur peut effectuer plusieurs réservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Relation : Un utilisateur peut réaliser plusieurs paiements
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Relation : Un utilisateur peut laisser plusieurs avis
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relation : Un utilisateur peut recevoir plusieurs notifications
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Relation : Un utilisateur peut générer plusieurs logs
    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
